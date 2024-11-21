<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
{
    protected $data = []; // Create a protected property for the data array

    public function __construct()
    {
        parent::__construct();
        // Load the session library
        $this->load->library('session');
        // Load the Account_model
        $this->load->model('Account_model');

        // Set a default title
        $this->data['title'] = get_class($this); // Base title
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        $this->data['user'] = $this->Account_model->get_user_by_id($user_id);

        // Set the active page
        $this->data['active_page'] = 'about'; // Set 'about' as the active page

        // Load the view with the user data and active page
        $this->load->view('tentang_kami', $this->data); // Replace with your actual view file
    }
}
