<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Deposit extends CI_Controller
{
    protected $data = []; // Create a protected property for the data array

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Deposit_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('session');

        // Check if the user is logged in
        if (!$this->session->userdata('logged_in')) {
            // If not logged in, redirect to the auth controller
            redirect('auth'); // Replace with your actual auth controller route
        }

        // Set a default title
        $this->data['title'] = get_class($this); // Base title
    }

    public function index()
    {
        $this->data['jenis_sampah'] = $this->Deposit_model->get_jenis_sampah(); // Get jenis sampah for the form
        $this->data['setoran'] = $this->Deposit_model->get_all_setoran(); // Fetch all setoran for display

        // Load the view and pass data
        $this->data['title'] = 'Setoran Sampah';
        $this->load->view('setoran_sampah', $this->data);
    }

    public function add()
    {
        // Get the current user's ID
        $id_user = $this->session->userdata('user_id');

        // Generate a unique transaction code
        $kode_transaksi = 'TRX-' . date('YmdHis') . '-' . rand(100, 999); // Format: TRX-20241014-123456-123

        // Prepare the deposit data
        $data = array(
            'id_user' => $id_user,
            'id_jenis' => $this->input->post('id_jenis'),
            'id' => $kode_transaksi, // Use the generated transaction code
            'jumlah' => $this->input->post('jumlah'),
            'keterangan' => $this->input->post('keterangan'),
        );

        // Insert the deposit data into the database
        if ($this->Deposit_model->add_setoran($data)) {

            // Calculate the points (jumlah * 1500)
            $points = $data['jumlah'] * 1500;

            // Debugging: Check current user points before the update
            $this->db->select('point'); // Correct filtering by user ID
            $current_points = $this->db->get('users')->row();
            var_dump($current_points); // Display current points for debugging

            // Update the user's points in the `users` table
            $this->db->set('point', 'point + ' . (int)$points, FALSE);  // Filter by user ID
            $this->db->update('users');

            // Debugging: Check user points after the update
            $this->db->select('point'); // Again filter by `user_id`
            $updated_points = $this->db->get('users')->row();
            var_dump($updated_points); // Display updated points for debugging

            // Include points in the data array for further use
            $data['points_awarded'] = $points;

            // Set success message
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Setoran berhasil ditambahkan! Anda mendapatkan ' . $points . ' poin. Kode Transaksi: ' . $kode_transaksi . '. Terima kasih atas kontribusi Anda.</div>');
        } else {
            // Set error message
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan setoran. Silakan coba lagi.</div>');
        }

        // Redirect back to the deposit page
        redirect('deposit');
    }
}
