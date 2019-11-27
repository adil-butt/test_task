<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
	public function viewAllCompanies() {
		$data['title'] = 'Companies';
		$data['template'] = 'pages/all_companies';
		$data['companies'] = $this->CompanyModel->getResult();
		$this->load->view('template/template', $data);
	}
	public function viewAllPersons() {
		$data['title'] = 'Persons';
		$data['template'] = 'pages/all_persons';
		$data['persons'] = $this->PersonModel->getResultWithJoin();
		$this->load->view('template/template', $data);
	}
	public function viewAllAddress() {
		$data['title'] = 'Addresses';
		$data['template'] = 'pages/all_addresses';
		$data['addresses'] = $this->PersonAddressModel->getResultWithJoin();
		$this->load->view('template/template', $data);
	}
}
