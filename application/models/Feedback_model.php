<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Feedback_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Method to insert feedback
    public function insert_feedback($data)
    {
        return $this->db->insert('kritik_saran', $data);
    }

    // Method to retrieve all feedback
    public function get_all_feedback()
    {
        return $this->db->get('kritik_saran')->result();
    }

    public function get_user_by_id($user_id)
    {
        return $this->db->get_where('users', ['id' => $user_id])->row();
    }

    public function get_feedback_by_user_id($user_id)
    {
        $this->db->where('id_user', $user_id); // Filter by user ID
        $query = $this->db->get('kritik_saran');
        return $query->result(); // Return result as array of objects
    }
}
