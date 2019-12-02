<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 *        http://example.com/index.php/welcome
	 *    - or -
	 *        http://example.com/index.php/welcome/index
	 *    - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 * @param $id
	 * @return bool
	 */

	function person_name_exists($id) {
		$where = array('id' => $id);
		if($this->PersonModel->getResult($where)) {
			return true;
		} else {
			$this->form_validation->set_message('person_name_exists', 'Person not found');
			return false;
		}
	}

	public function addContactPersonAddress() {
		$this->form_validation->set_rules('pAddress', 'Person\'s Address', 'trim|max_length[50]|min_length[3]|required');
		if(!$this->input->post('pUpdateAddressId')) {
			$this->form_validation->set_rules('pAddName', 'Person Name', 'trim|required|callback_person_name_exists');
		}
		if($this->form_validation->run() == TRUE) {
			$data = array(
				'address' => $this->input->post('pAddress'),
			);
			if(!$this->input->post('pUpdateAddressId')) {
				$data['person_id'] = $this->input->post('pAddName');
				if($this->PersonAddressModel->insertNewAddress($data)) {
					$this->session->set_flashdata('success', 'Address added successfully');
				} else {
					$this->session->set_flashdata('error', 'Something went wrong');
				}
			} else {
				$where = array('id' => $this->input->post('pUpdateAddressId'));
				if($this->PersonAddressModel->updateAddress($data, $where)) {
					$this->session->set_flashdata('success', 'Address updated successfully');
				} else {
					$this->session->set_flashdata('error', 'Something went wrong');
				}
			}
		} else {
			if($this->input->post('pUpdateAddressId')) {
				$this->session->set_flashdata('error', 'Something went wrong');
			}
		}
		if($this->input->post('pUpdateAddressId')) {
			$data['title'] = 'Addresses';
			$data['template'] = 'pages/all_addresses';
			$data['addresses'] = $this->PersonAddressModel->getResultWithJoin();
			$this->load->view('template/template', $data);
		} else {
			$data['title'] = 'Add';
			$data['template'] = 'admin/add';
			$data['companies'] = $this->CompanyModel->getResult();
			$data['persons'] = $this->PersonModel->getResult();
			$this->load->view('template/template', $data);
		}
	}

	function company_name_exists($id) {
		$where = array('id' => $id);
		if($this->CompanyModel->getResult($where)) {
			return true;
		} else {
			$this->form_validation->set_message('company_name_exists', 'Company not found');
			return false;
		}
	}

	public function addContactPerson() {
		$this->form_validation->set_rules('pName', 'Person Name', 'trim|max_length[50]|min_length[3]|required');
		$this->form_validation->set_rules('pCompany', 'Company Name', 'trim|required|callback_company_name_exists');
		if($this->form_validation->run() == TRUE) {
			$data = array(
				'person_name' => $this->input->post('pName'),
				'company_id' => $this->input->post('pCompany'),
			);
			$where = array(
				'company_id' => $this->input->post('pCompany'),
				'default_person' => '1'
			);
			if($this->input->post('personId')) {
				if($this->PersonModel->countRows($where) < 2) {
					$data['default_person'] = 1;
				} else {
					if($this->input->post('makeDefault') == 'on') {
						$data['default_person'] = 1;
					} else {
						$data['default_person'] = 0;
					}
				}
			} else {
				if($this->PersonModel->countRows($where) < 1) {
					$data['default_person'] = 1;
				} else {
					if($this->input->post('makeDefault') == 'on') {
						$data['default_person'] = 1;
					} else {
						$data['default_person'] = 0;
					}
				}
			}
			if($this->input->post('personId')) {
				$where = array('id' => $this->input->post('personId'));
				if($this->PersonModel->updatePerson($data, $where)) {
					$this->session->set_flashdata('success', 'Person updated successfully');
				} else {
					$this->session->set_flashdata('error', 'Something went wrong');
				}
			} else {
				if($this->PersonModel->insertNewPerson($data)) {
					$this->session->set_flashdata('success', 'Person added successfully');
				} else {
					$this->session->set_flashdata('error', 'Something went wrong');
				}
			}
		} else {
			if($this->input->post('personId')) {
				$this->session->set_flashdata('error', 'Something went wrong');
			}
		}
		if($this->input->post('personId')) {
			$data['title'] = 'Persons';
			$data['template'] = 'pages/all_persons';
			$data['persons'] = $this->PersonModel->getResultWithJoin();
			$this->load->view('template/template', $data);
		} else {
			$data['title'] = 'Add';
			$data['template'] = 'admin/add';
			$data['companies'] = $this->CompanyModel->getResult();
			$data['persons'] = $this->PersonModel->getResult();
			$this->load->view('template/template', $data);
		}
	}

	public function delete() {
		if(isset($_GET['delete'])) {
			if($_GET['delete'] == 'delete_company') {
				$where = array('id' => $_GET['delete_id']);
				if($this->CompanyModel->deleteCompany($where)) {
					$this->session->set_flashdata('success', 'Company deleted successfully');
				} else {
					$this->session->set_flashdata('success', 'Something went wrong');
				}
				$data['title'] = 'Companies';
				$data['template'] = 'pages/all_companies';
				$data['companies'] = $this->CompanyModel->getResult();
				$this->load->view('template/template', $data);
			} elseif($_GET['delete'] == 'delete_person') {
				$where = array('id' => $_GET['delete_id']);
				$row = $this->PersonModel->getResult($where);
				if($row) {
					if($row[0]['default_person'] == '1') {
						$where = array(
							'company_id' => $row[0]['company_id'],
							'default_person' => '1'
						);
						if($this->PersonModel->countRows($where) < 2) {
							$this->session->set_flashdata('error', 'Person not deleted. First Make another person as default person');
						} else {
							$where = array('id' => $_GET['delete_id']);
							if($this->PersonModel->deletePerson($where)) {
								$this->session->set_flashdata('success', 'Person deleted successfully');
							} else {
								$this->session->set_flashdata('error', 'Something went wrong');
							}
						}
					} else {
						if($this->PersonModel->deletePerson($where)) {
							$this->session->set_flashdata('success', 'Person deleted successfully');
						} else {
							$this->session->set_flashdata('error', 'Something went wrong');
						}
					}	
				} else {
					$this->session->set_flashdata('error', 'Something went wrong');
				}
				$data['title'] = 'Persons';
				$data['template'] = 'pages/all_persons';
				$data['persons'] = $this->PersonModel->getResultWithJoin();
				$this->load->view('template/template', $data);
			} elseif($_GET['delete'] == 'delete_address') {
				$where = array('id' => $_GET['delete_id']);
				if($this->PersonAddressModel->deleteAddress($where)) {
					$this->session->set_flashdata('success', 'Address deleted successfully');
				} else {
					$this->session->set_flashdata('error', 'Something went wrong');
				}
				$data['title'] = 'Addresses';
				$data['template'] = 'pages/all_addresses';
				$data['addresses'] = $this->PersonAddressModel->getResultWithJoin();
				$this->load->view('template/template', $data);
			}
		}
	}

	public function addCompany() {
		$this->form_validation->set_rules('comName', 'Company Name', 'trim|max_length[50]|min_length[3]|required');
		$this->form_validation->set_rules('comAddress', 'Company Address', 'trim|max_length[50]|min_length[5]|required');
		$this->form_validation->set_rules('comEmail', 'Email', 'trim|max_length[100]|min_length[5]|valid_email|required');
		$this->form_validation->set_rules('comPhone', 'Phone', 'trim|exact_length[11]|numeric|required');
		if($this->form_validation->run() == TRUE) {
			$data = array(
				'company_name' => $this->input->post('comName'),
				'company_address' => $this->input->post('comAddress'),
				'company_email' => $this->input->post('comEmail'),
				'company_phone' => $this->input->post('comPhone'),
			);
			if($this->input->post('companyId')) {
				$where = array('id' => $this->input->post('companyId'));
				if($this->CompanyModel->updateCompany($data, $where)) {
					$this->session->set_flashdata('success', 'Company updated successfully');
				} else {
					$this->session->set_flashdata('error', 'Something went wrong');
				}
			} else {
				if($this->CompanyModel->insertNewCompany($data)) {
					$this->session->set_flashdata('success', 'Company created successfully');
				} else {
					$this->session->set_flashdata('error', 'Something went wrong');
				}
			}
		} else {
			if($this->input->post('companyId')) {
				$this->session->set_flashdata('error', 'Something went wrong');
			}
		}
		if($this->input->post('companyId')) {
			$data['title'] = 'Companies';
			$data['template'] = 'pages/all_companies';
			$data['companies'] = $this->CompanyModel->getResult();
			$this->load->view('template/template', $data);
		} else {
			$data['title'] = 'Add';
			$data['template'] = 'admin/add';
			$data['companies'] = $this->CompanyModel->getResult();
			$data['persons'] = $this->PersonModel->getResult();
			$this->load->view('template/template', $data);
		}
	}

	public function add() {
		$data['title'] = 'Add';
		$data['template'] = 'admin/add';
		$data['companies'] = $this->CompanyModel->getResult();
		$data['persons'] = $this->PersonModel->getResult();
		$this->load->view('template/template', $data);
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['companies'] = $this->CompanyModel->getResult();
		$data['template'] = 'admin/dashboard';
		$this->load->view('template/template', $data);
	}
}
