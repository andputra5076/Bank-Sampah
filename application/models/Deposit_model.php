<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Deposit_model extends CI_Model
{

    // Method to add a new waste deposit
    public function add_setoran($data)
    {
        return $this->db->insert('setoran_sampah', $data);
    }

    // Method to get all waste deposits with jenis
    public function get_all_setoran()
    {
        $this->db->select('setoran_sampah.*, jenis.nama as jenis');
        $this->db->from('setoran_sampah');
        $this->db->join('jenis', 'setoran_sampah.id_jenis = jenis.id', 'left');
        $this->db->order_by('setoran_sampah.id', 'DESC');
        return $this->db->get()->result();
    }

    // Optional: Method to get a specific setoran by id
    public function get_setoran_by_id($id)
    {
        return $this->db->get_where('setoran_sampah', ['id' => $id])->row();
    }

    public function get_jenis_sampah()
    {
        $this->db->select('id, nama'); // Adjust column name if different
        $query = $this->db->get('jenis');
        return $query->result(); // Return as array of objects
    }
}
