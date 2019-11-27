<?php
class PersonModel extends CI_Model {
	public function insertNewPerson($data) {
		return $this->db->insert('person', $data);
	}
	public function updatePerson($data, $where) {
		return $this->db->update('person', $data, $where);
	}
	public function deletePerson($where) {
		return $this->db->delete('person', $where);
	}
	public function getResult($where = '') {
		if($where != '') {
			$this->db->where($where);
		}
		$query = $this->db->get('person');
		return $query->result_array();
	}
	public function countRows($where = '') {
		if($where != '') {
			$this->db->where($where);
		}
		return $this->db->count_all_results('person');
	}
	public function getResultWithJoin($where = '') {
		$this->db->select('*, company.id AS company_id, person.id AS person_id');
		$this->db->from('person');
		if($where != '') {
			$this->db->where($where);
		}
		$this->db->join('company', 'company.id = person.company_id');
		$query = $this->db->get();
		return $query->result_array();
	}
}
