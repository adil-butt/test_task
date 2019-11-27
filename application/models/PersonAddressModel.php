<?php
class PersonAddressModel extends CI_Model {
	public function insertNewAddress($data) {
		return $this->db->insert('person_address', $data);
	}
	public function updateAddress($data, $where) {
		return $this->db->update('person_address', $data, $where);
	}
	public function deleteAddress($where) {
		return $this->db->delete('person_address', $where);
	}
	public function getResult($where = '') {
		if($where != '') {
			$this->db->where($where);
		}
		$query = $this->db->get('person_address');
		return $query->result_array();
	}
	public function getResultWithJoin($where = '') {
		$this->db->select('*, person_address.id AS address_id, person.id AS person_id');
		$this->db->from('person_address');
		if($where != '') {
			$this->db->where($where);
		}
		$this->db->join('person', 'person.id = person_address.person_id');
		$query = $this->db->get();
		return $query->result_array();
	}
}
