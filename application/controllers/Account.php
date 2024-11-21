<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends CI_Controller
{
    protected $data = []; // Create a protected property for the data array

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

    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        $this->data['user'] = $this->Account_model->get_user_by_id($user_id);
        // Load the welcome message view with default title
        $this->load->view('akun', $this->data); // Replace with your actual view file
    }

    public function profile()
    {
        // Get the user ID from the session
        $user_id = $this->session->userdata('user_id');

        // Retrieve user data
        $this->data['user'] = $this->Account_model->get_user_by_id($user_id);
        // Set title for the profile view
        $this->data['title'] = 'Profil';

        // Load the profile view with user data
        $this->load->view('profil', $this->data);
    }
    public function address()
    {
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
        $this->load->view('address', $this->data);
    }
    
    
// Function to fetch provinces from RajaOngkir API
private function get_provinces()
{
    $apiKey = '19fd1eb23f30951e0de2ba92edbb0cdf';  // Your RajaOngkir API key
    $url = 'https://api.rajaongkir.com/starter/province';  // RajaOngkir API endpoint for provinces

    // Initialize cURL
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'key: ' . $apiKey
    ]);

    // Execute cURL and get the response
    $response = curl_exec($ch);

    // Close the cURL session
    curl_close($ch);

    // Decode the response JSON into an associative array
    $responseData = json_decode($response, true);

    // Return the provinces list
    if (isset($responseData['rajaongkir']['results'])) {
        return $responseData['rajaongkir']['results'];
    }

    return [];
}
public function get_cities($province_id)
{
    // Your RajaOngkir API key
    $apiKey = '19fd1eb23f30951e0de2ba92edbb0cdf'; 

    // RajaOngkir API endpoint for cities
    $url = "https://api.rajaongkir.com/starter/city?province=$province_id"; 

    // Initialize cURL
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'key: ' . $apiKey
    ]);

    // Execute cURL and get the response
    $response = curl_exec($ch);

    // Check for errors
    if(curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }

    // Close the cURL session
    curl_close($ch);

    // Decode the response
    $responseData = json_decode($response, true);

    // Check if cities data exists and return it
    if (isset($responseData['rajaongkir']['results'])) {
        echo json_encode($responseData['rajaongkir']['results']);
    } else {
        echo json_encode([]);
    }
}



    public function edit_profile()
    {
        // Get the user ID from the session
        $user_id = $this->session->userdata('user_id');

        // Validate form input
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('telepon', 'Telepon', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            // If validation fails, load the profile view again
            $this->profile();
        } else {
            // Prepare data for updating
            $data = array(
                'username' => $this->input->post('username'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'email' => $this->input->post('email'),
                'telepon' => $this->input->post('telepon'),
            );

            $user = $this->Account_model->get_user_by_id($user_id);

            // Check if the user uploaded a new foto_profil
            if (!empty($_FILES['foto_profil']['name'])) {
                $config['upload_path'] = './assets/images/'; // Adjust the path as needed
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 2048; // Set max size to 2MB
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto_profil')) {
                    $upload_data = $this->upload->data();
                    $data['foto_profil'] = 'assets/images/' . $upload_data['file_name']; // Store the file name in the data array
                } else {
                    // Set error message if the upload fails
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('account/profile'); // Fixed redirect to profile
                    return;
                }
            } else {
                // If no new foto_profil uploaded, use the default profile picture from assets/images
                if (!empty($user->foto_profil)) {
                    $data['foto_profil'] = $user->foto_profil;
                } else {
                    // Use default profile picture if no existing profile picture
                    $data['foto_profil'] = 'assets/images/default_profil.png';
                } // Default profile picture path
            }

            // Check if the password field is not empty
            $password = $this->input->post('password');
            if (!empty($password)) {
                // Hash the password using MD5
                $data['password'] = md5($password);
            }

            // Update user data
            if ($this->Account_model->update_user($user_id, $data)) {
                // Set success message
                $this->session->set_flashdata('success', 'Profil berhasil diperbarui.');
            } else {
                // Set error message
                $this->session->set_flashdata('error', 'Gagal memperbarui profil.');
            }

            // Redirect back to profile page
            redirect('account/profile'); // Fixed redirect to profile
        }
    }

    public function edit_address()
    {
        // Get the user ID from the session
        $user_id = $this->session->userdata('user_id');

        // Validate form input
        $this->load->library('form_validation');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == FALSE) {
            // If validation fails, reload the address view
            $this->address();
        } else {
            // Get the address input
            $alamat = $this->input->post('alamat');

            // Update user address data in the database
            if ($this->Account_model->update_user_address($user_id, ['alamat' => $alamat])) {
                // Set success message
                $this->session->set_flashdata('success', 'Alamat berhasil diperbarui.');
            } else {
                // Set error message
                $this->session->set_flashdata('error', 'Gagal memperbarui alamat.');
            }

            // Redirect back to address page
            redirect('account/address');
        }
    }
    public function shipping() {
        
        $this->load->view('shipping');
    }
}
