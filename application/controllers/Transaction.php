<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
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
        $this->data['title'] = 'Histori Transaksi';
        $this->load->view('transaksi', $this->data);
    }

    public function add()
    {
        
    }
}
