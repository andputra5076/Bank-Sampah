<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account_model extends CI_Model
{

    // Constructor
    public function __construct()
    {
        parent::__construct();
        // Load the database
        $this->load->database();
    }

    // Method to add a new user
    public function add_user($data)
    {
        return $this->db->insert('users', $data);
    }

    // Method to get a user by ID
    public function get_user_by_id($user_id)
    {
        return $this->db->get_where('users', ['id' => $user_id])->row();
    }


    public function update_user_address($user_id, $data)
    {
        // Melakukan update pada tabel pengguna berdasarkan user_id
        $this->db->where('id', $user_id); // Pastikan 'id' adalah nama kolom ID pengguna
        return $this->db->update('users', $data); // Gantilah 'users' dengan nama tabel yang sesuai
    }

    // Method to update user information
    public function update_user($user_id, $data)
    {
        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }

    // Method to delete a user
    public function delete_user($user_id)
    {
        return $this->db->delete('users', ['id' => $user_id]);
    }

    // Method to get all users
    public function get_all_users()
    {
        return $this->db->get('users')->result();
    }

    // Method to find a user by email (for login purposes)
    public function get_user_by_email($email)
    {
        return $this->db->get_where('users', ['email' => $email])->row();
    }
}
