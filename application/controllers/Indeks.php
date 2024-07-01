<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Indeks extends CI_Controller {
	function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->model('Userdata_model');
		$this->load->model('Indeks_model');
		is_logged_in();
	}

	function index() {
		$data = [
				'title' => 'SIPAS - '.$this->db->get_where('companysetting', ['CompanyID' => 1])->row()->CompanyName,
				'userdata' => $this->Userdata_model->get_userdata($this->session->userdata('Username')),
		];

    $this->load->view('back-end/template/header', $data);
    $this->load->view('back-end/template/sidebar');
    $this->load->view('back-end/indeks');
    $this->load->view('back-end/template/footer');
	}

  function get_dataindeks(){
		 $dataindeks = $this->Indeks_model->get_dataindeks();
		 $data = array();
     $i = 1;
		 foreach($dataindeks as $di){
					$sub_array = array();

					if (!$di->IndeksDesc) {
						$idesc = "<i>tidak ada deskripsi</i>";
					} else {
						$idesc = $di->IndeksDesc;
					}

					$sub_array[] = '<p class="text-muted text-center mb-0">'.$i++.'.</p>';
					$sub_array[] = '<p class="text-muted text-center mb-0">'.$di->IndeksName.'</p>';
					$sub_array[] = '<p class="text-muted text-center mb-0"><b>'.$di->IndeksCode.'</b></p>';
					$sub_array[] = '<p class="text-muted text-center mb-0">'.$idesc.'</p>';
					$sub_array[] = '<div class="text-center">
															<ul class="list-inline mb-0 font-size-16">
																	<li class="list-inline-item">
																			<a href="#" class="text-danger p-1" onclick="method_delete(\''.$di->IndeksID.'\')"><i class="bx bxs-trash"></i></a>
																	</li>
															</ul>
													</div>';


					$data[] = $sub_array;
		 }
		 $output = array(
					"draw"             =>     intval($_POST["draw"]),
					"recordsTotal"     =>     $this->Indeks_model->get_all_dataindeks(),
					"recordsFiltered"  =>     $this->Indeks_model->get_filtered_dataindeks(),
					"data"             =>     $data,
		 );
		 header('Content-Type: application/json; charset=utf-8');
		 echo json_encode($output);
	}

  function check_duplicateid($id){
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->Indeks_model->check_duplicateid($id));
  }

  function add_indeks(){
    $data = array(
      'IndeksCode' 	=> strtoupper($this->input->post('input-IndeksCode')),
      'IndeksName' 	=> ucwords($this->input->post('input-IndeksName')),
      'IndeksDesc' => (!empty($this->input->post('input-IndeksDesc'))) ? strtolower($this->input->post('input-IndeksDesc')) : NULL,
    );

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->Indeks_model->add_indeks($data));
  }

  function delete_indeks($id){
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->Indeks_model->delete_indeks($id));
  }

}
