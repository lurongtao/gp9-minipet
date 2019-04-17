<?php
class Trade_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function get_list() {
		$this->db->select('id, latitude, longitude, type');
		$query = $this->db->get('student_list');
		return $query->result_array();
	}

	public function add_item($data) {
		return $this->db->insert('student_list', $data);
	}

	public function get_around_points($latitude, $longitude) {
		$this->db->select('id');
		$this->db->where('latitude', $latitude); 
		$this->db->where('longitude', $longitude);
		$query = $this->db->get('student_list');
		return $query->result_array();
	}

	public function get_item($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('student_list');
		return $query->row();
	}

	public function get_search_list($keyword) {
		$this->db->like('message', $keyword); 
		$query = $this->db->get('student_list');
		return $query->result_array();
	}

}