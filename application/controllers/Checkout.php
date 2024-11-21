<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        // Load the session library
        $this->load->library('session');
        // Load the Account_model
        $this->load->model('Account_model');

        // Check if the user is logged in
        if (!$this->session->userdata('logged_in')) {
            // If not logged in, redirect to the auth controller
            redirect('auth'); // Replace with your actual auth controller route
        }

        // Set a default title
        $this->data['title'] = get_class($this); // Base title
    }

    public function index($id = null) {
        // Pastikan ID valid
        if (!is_numeric($id)) {
            show_404();
        }

       
       // Get the user ID from the session
       $user_id = $this->session->userdata('user_id');
    
       // Retrieve user data
       $this->data['user'] = $this->Account_model->get_user_by_id($user_id);
   
       // Check if user data is found
       if ($this->data['user']) {
           // Set title for the address view
           $this->data['title'] = 'Alamat Pengiriman';
   
           // Get the list of provinces from RajaOngkir API
           $this->data['provinces'] = $this->get_provinces();
   
           // Parse the alamat to get city and province ids
           $alamat = $this->data['user']->alamat;
           $alamat_parts = explode("//", $alamat);
           
           if (count($alamat_parts) == 2) {
               $city_province = explode(",", $alamat_parts[1]);
               
               // Extract city and province IDs
               $this->data['city_id'] = trim($city_province[0]);
               $this->data['province_id'] = trim($city_province[1]);
           } else {
               // Handle cases where the address format is invalid
               $this->data['city_id'] = '';
               $this->data['province_id'] = '';
           }
   
           // Set alamat field for display
           $this->data['alamat'] = $alamat;
       } else {
           // Handle case where user does not exist (optional)
           show_404(); // Or redirect to a different page
       }
   
       // Load the address view with user data, provinces, and alamat
     

        // Load View dengan Data Produk dan Gambar
        $this->load->view('checkout', $this->data);
    }
}
?>
