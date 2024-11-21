<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Fungsi untuk mendaftarkan pengguna baru
    public function register($data) {
        $data['password'] = md5($data['password']);
        return $this->db->insert('users', $data);
    }

    // Fungsi untuk mendapatkan pengguna berdasarkan email atau username
    public function get_user($email_or_username) {
        $this->db->where('email', $email_or_username);
        $this->db->or_where('username', $email_or_username);
        return $this->db->get('users')->row();
    }

    // Fungsi untuk mengecek apakah email sudah ada
    public function check_email_exists($email) {
        $query = $this->db->get_where('users', array('email' => $email));
        return $query->num_rows() > 0;
    }
}
