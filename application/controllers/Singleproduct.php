<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Singleproduct extends CI_Controller {

    public function index($id = null) {
        // Pastikan ID valid
        if (!is_numeric($id)) {
            show_404();
        }

        // Load Database
        $this->load->database();

        // Query Produk Berdasarkan ID
        $query = $this->db->get_where('produk', ['id_produk' => $id]);
        $data['produk'] = $query->row_array(); // Mengambil satu data produk

        // Jika Produk Tidak Ditemukan
        if (!$data['produk']) {
            show_404();
        }

        // Query untuk Mengambil Semua Gambar Produk
        $this->db->select('url_thumbnail');
        $this->db->from('image');
        $this->db->where('id_produk', $id);
        $query_image = $this->db->get();
        $data['images'] = $query_image->result_array(); // Mengambil semua gambar

       

        // Load View dengan Data Produk dan Gambar
        $this->load->view('singleproduct', $data);
    }
}
?>
