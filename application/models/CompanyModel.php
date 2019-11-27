<?php
class CompanyModel extends CI_Model {
	public function insertNewCompany($data) {
		return $this->db->insert('company', $data);
	}
	public function updateCompany($data, $where) {
		return $this->db->update('company', $data, $where);
	}
	public function deleteCompany($where) {
		return $this->db->delete('company', $where);
	}
	public function getResult($where = '') {
		if($where != '') {
			$this->db->where($where);
		}
		$query = $this->db->get('company');
		return $query->result_array();
	}
}
