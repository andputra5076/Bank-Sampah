<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index() {
        // Load the welcome message view
        $data['active_page'] = 'home';
        $this->load->view('welcome_message', $data); // Replace with your actual view file
    }
}
?>
