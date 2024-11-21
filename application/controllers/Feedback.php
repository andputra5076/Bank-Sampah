<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Feedback extends CI_Controller
{
    protected $data = []; // Create a protected property for the data array

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Feedback_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('Feedback_model');
        $this->load->library('session');
    }

    // Method to display the feedback form
    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        if ($user_id) {
            $this->data['user'] = $this->Feedback_model->get_user_by_id($user_id);
            $this->data['feedback'] = $this->Feedback_model->get_feedback_by_user_id($user_id);
        } else {
            $this->data['user'] = null;
            $this->data['feedback'] = []; // or handle as needed, e.g., redirect to login
        }
        // Set the title for the page
        $this->data['title'] = 'Kritik dan Saran';

        // Set the active page
        $this->data['active_page'] = 'feedback';

        // Load the feedback form view and pass the data
        $this->load->view('kritik_saran', $this->data); // Create this view to display the form
    }


    // Method to handle form submission
    public function submit_feedback()
    {
        $id_user = $this->session->userdata('user_id');
        $this->form_validation->set_rules('nama', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('pesan', 'Message', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Reload the form with validation errors
            $this->load->view('kritik_saran', $this->data);
        } else {
            $data = [
                'id_user' => $id_user,
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'pesan' => $this->input->post('pesan')
            ];
            $this->Feedback_model->insert_feedback($data);
            $this->session->set_flashdata('success', 'Terima kasih atas kritik dan saran Anda.');
            redirect('feedback'); // Change this to your desired redirect after submission
        }
    }

    // Method to display all feedback (optional)
    public function view_feedback()
    {
        $this->data['feedback'] = $this->Feedback_model->get_all_feedback();
        $this->load->view('view_feedback', $this->data); // Create this view to display feedback
    }
}
