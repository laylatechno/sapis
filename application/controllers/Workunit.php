<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Workunit extends CI_Controller {
	function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->model('Userdata_model');
		$this->load->model('Workunit_model');
		is_logged_in();
	}

	function index() {
		$data = [
				'title' => 'SIPAS - '.$this->db->get_where('companysetting', ['CompanyID' => 1])->row()->CompanyName,
				'userdata' => $this->Userdata_model->get_userdata($this->session->userdata('Username')),
		];

    $this->load->view('back-end/template/header', $data);
    $this->load->view('back-end/template/sidebar');
    $this->load->view('back-end/workunit');
    $this->load->view('back-end/template/footer');
	}

  function get_dataworkunit(){
		 $dataworkunit = $this->Workunit_model->get_dataworkunit();
		 $data = array();
     $i = 1;
		 foreach($dataworkunit as $dc){
					$sub_array = array();

					if (!$dc->WorkunitDesc) {
						$cdesc = "<i>tidak ada deskripsi</i>";
					} else {
						$cdesc = $dc->WorkunitDesc;
					}

					$sub_array[] = '<p class="text-muted text-center mb-0">'.$i++.'.</p>';
					$sub_array[] = '<p class="text-muted text-center mb-0">'.$dc->WorkunitName.'</p>';
					$sub_array[] = '<p class="text-muted text-center mb-0"><b>'.$dc->WorkunitCode.'</b></p>';
					$sub_array[] = '<p class="text-muted text-center mb-0">'.$cdesc.'</p>';
					$sub_array[] = '<div class="text-center">
															<ul class="list-inline mb-0 font-size-16">
																	<li class="list-inline-item">
																			<a href="#" class="text-danger p-1" onclick="method_delete(\''.$dc->WorkunitID.'\')"><i class="bx bxs-trash"></i></a>
																	</li>
															</ul>
													</div>';


					$data[] = $sub_array;
		 }
		 $output = array(
					"draw"             =>     intval($_POST["draw"]),
					"recordsTotal"     =>     $this->Workunit_model->get_all_dataworkunit(),
					"recordsFiltered"  =>     $this->Workunit_model->get_filtered_dataworkunit(),
					"data"             =>     $data,
		 );
		 header('Content-Type: application/json; charset=utf-8');
		 echo json_encode($output);
	}

  function check_duplicateid($id){
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->Workunit_model->check_duplicateid($id)->num_rows());
  }

  function add_workunit(){
    $data = array(
      'WorkunitCode' 	=> strtoupper($this->input->post('input-WorkunitCode')),
      'WorkunitName' 	=> ucwords($this->input->post('input-WorkunitName')),
      'WorkunitDesc' => (!empty($this->input->post('input-WorkunitDesc'))) ? $this->input->post('input-WorkunitDesc') : NULL,
    );

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->Workunit_model->add_workunit($data));
  }

  function delete_workunit($id){
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->Workunit_model->delete_workunit($id));
  }

}
