<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function index() {
        // Load the welcome message view
        $data['active_page'] = 'product';
        $this->load->database();
       
        
        // Query dengan Subquery untuk mengambil satu gambar
        $this->db->select('produk.*, (SELECT url_thumbnail FROM image WHERE image.id_produk = produk.id_produk LIMIT 1) AS url_thumbnail');
        $this->db->from('produk');
        $query = $this->db->get();

        // Menyimpan hasil query ke array
        $data['produk'] = $query->result_array();

        $this->load->view('produk', $data); // Replace with your actual view file
    }
}
?>
