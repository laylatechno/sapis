<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Outgoing_report extends CI_Controller {
	function __construct(){
		parent::__construct();
		error_reporting(0);
    $this->load->model('Companydata_model');
		$this->load->model('Userdata_model');
		$this->load->model('Report_model');
		is_logged_in();
	}

	function index() {
		$data = [
				'title' => 'SIPAS - '.$this->db->get_where('companysetting', ['CompanyID' => 1])->row()->CompanyName,
				'userdata' => $this->Userdata_model->get_userdata($this->session->userdata('Username')),
        'companydata' => $this->Companydata_model->get_companydata(),
		];

    $this->load->view('back-end/template/header', $data);
    $this->load->view('back-end/template/sidebar');
    $this->load->view('back-end/report/outgoing-report');
    $this->load->view('back-end/template/footer');
	}

	function report_outmail() {
		$startdate = date('Y-m-d',strtotime($this->input->post('input-DateStart')));
		$enddate = date('Y-m-d',strtotime($this->input->post('input-DateEnd')));
		$workunit = $this->input->post('input-WorkunitID');

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Report_model->report_outmail($startdate, $enddate, $workunit));
	}

}
