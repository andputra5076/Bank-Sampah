<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index()
    {
        redirect('auth/login'); // Redirect ke halaman login
    }

    // Fungsi untuk menampilkan halaman login
    public function login()
    {
        $this->load->view('auth/login');
    }

    // Proses login
    public function do_login()
    {
        // Mengatur aturan validasi
        $this->form_validation->set_rules('email', 'Email/Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        // Memeriksa apakah validasi berhasil
        if ($this->form_validation->run() === FALSE) {
            // Jika validasi gagal, tampilkan halaman login kembali
            $this->load->view('auth/login');
        } else {
            $email_or_username = $this->input->post('email');
            $password = md5($this->input->post('password')); // Menggunakan MD5 untuk mengenkripsi password

            // Ambil user berdasarkan email atau username
            $user = $this->Auth_model->get_user($email_or_username);

            // Verifikasi password
            if ($user && $user->password === $password) {
                // Jika valid, simpan informasi pengguna ke session
                $user_data = array(
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                    'nama_lengkap' => $user->nama_lengkap,
                    'telepon' => $user->telepon,
                    'alamat' => $user->alamat,
                    'foto_profil' => $user->foto_profil,
                    'level' => $user->level,
                    'point' => $user->point,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($user_data);
                redirect('home'); // Ganti dengan halaman setelah login
            } else {
                $this->session->set_flashdata('error', 'Email atau Password salah');
                redirect('auth/login');
            }
        }
    }

    // Fungsi untuk menampilkan halaman register
    public function register()
    {
        $this->load->view('auth/register');
    }

    // Proses register
    public function do_register()
    {
        // Mengatur pesan error untuk validasi
        $this->form_validation->set_message('min_length', 'Kolom Password harus terdiri dari setidaknya 6 karakter.');
        $this->form_validation->set_message('matches', 'Kolom Konfirmasi Password tidak sesuai dengan Kolom Password.');

        // Aturan validasi
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');

        // Memeriksa apakah validasi berhasil
        if ($this->form_validation->run() === FALSE) {
            // Jika validasi gagal, tampilkan halaman registrasi kembali
            $this->load->view('auth/register');
        } else {
            // Menyiapkan data untuk disimpan
            $data = array(
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password'))
            );

            // Simpan data registrasi ke dalam database
            if ($this->Auth_model->register($data)) {
                // Ambil user yang baru didaftarkan
                $user = $this->Auth_model->get_user($data['username']);

                // Simpan informasi pengguna ke session untuk login otomatis
                $user_data = array(
                    'id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                    'level' => $user->level,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($user_data);  // Menyimpan data ke session

                // Redirect ke halaman dashboard atau halaman lain yang sesuai
                redirect('home');
            } else {
                $this->session->set_flashdata('error', 'Registrasi gagal, silahkan coba lagi.');
                redirect('auth/register');
            }
        }
    }

    // Fungsi logout
    public function logout()
    {
        $this->session->unset_userdata(array('id', 'username', 'level', 'logged_in'));
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
