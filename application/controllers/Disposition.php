<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Disposition extends CI_Controller {
	function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->model('Userdata_model');
		$this->load->model('Disposition_model');
		$this->load->model('Maildetail_model');
		$this->load->model('Companydata_model');
		is_logged_in();
	}

	function index() {
		$data = [
				'title' => 'SIPAS - '.$this->db->get_where('companysetting', ['CompanyID' => 1])->row()->CompanyName,
				'userdata' => $this->Userdata_model->get_userdata($this->session->userdata('Username')),
		];

    $this->load->view('back-end/template/header', $data);
    $this->load->view('back-end/template/sidebar');
    $this->load->view('back-end/disposition/disposition');
    $this->load->view('back-end/template/footer');
	}

	function detail($id) {
		$query = $this->Maildetail_model->get_viewinmail($id);

		if ($query->InMailTrait == 'Rahasia' && $this->session->userdata('RoleID') == 4 && $query->Username != $this->session->userdata('Username')) {
			redirect(base_url('errorpage/not_acceptable'));
		} elseif ($query->InMailTrait == 'Rahasia' && $this->session->userdata('RoleID') == 3) {
			$data = [
					'title' => 'SIPAS - '.$this->db->get_where('companysetting', ['CompanyID' => 1])->row()->CompanyName,
					'userdata' => $this->Userdata_model->get_userdata($this->session->userdata('Username')),
			];

			$this->load->view('back-end/template/header', $data);
			$this->load->view('back-end/template/sidebar');
			$this->load->view('back-end/disposition/inbox-detail');
			$this->load->view('back-end/template/footer');
		} else {
			$data = [
					'title' => 'SIPAS - '.$this->db->get_where('companysetting', ['CompanyID' => 1])->row()->CompanyName,
					'userdata' => $this->Userdata_model->get_userdata($this->session->userdata('Username')),
			];

			$this->load->view('back-end/template/header', $data);
			$this->load->view('back-end/template/sidebar');
			$this->load->view('back-end/disposition/inbox-detail');
			$this->load->view('back-end/template/footer');
		}
	}

  function action($id) {
		$query = $this->Maildetail_model->get_viewinmail($id);

		if ($query->InMailTrait == 'Rahasia' && $this->session->userdata('RoleID') == 4 && $query->Username != $this->session->userdata('Username')) {
			redirect(base_url('errorpage/not_acceptable'));
		} elseif ($query->InMailTrait == 'Rahasia' && $this->session->userdata('RoleID') == 3) {
			$data = [
					'title' => 'SIPAS - '.$this->db->get_where('companysetting', ['CompanyID' => 1])->row()->CompanyName,
					'userdata' => $this->Userdata_model->get_userdata($this->session->userdata('Username')),
					'companydata' => $this->Companydata_model->get_companydata(),
			];

			$this->load->view('back-end/template/header', $data);
			$this->load->view('back-end/template/sidebar');
			$this->load->view('back-end/disposition/action');
			$this->load->view('back-end/template/footer');
		} else {
			$data = [
					'title' => 'SIPAS - '.$this->db->get_where('companysetting', ['CompanyID' => 1])->row()->CompanyName,
					'userdata' => $this->Userdata_model->get_userdata($this->session->userdata('Username')),
					'companydata' => $this->Companydata_model->get_companydata(),
			];

			$this->load->view('back-end/template/header', $data);
			$this->load->view('back-end/template/sidebar');
			$this->load->view('back-end/disposition/action');
			$this->load->view('back-end/template/footer');
		}
	}

	// ============================================================================================================= INCOMING MAIL

  function get_datainmail(){
		 $datainmail = $this->Disposition_model->get_datainmail();
		 $data = array();
     $i = 1;
		 foreach($datainmail as $dim){
					$sub_array = array();

					$valTrait = $dim->InMailTrait;
					if($valTrait == "Biasa"){
					    $trait = '<span class="badge badge-pill badge-soft-dark font-size-12">'.$valTrait.'</span>';
					} elseif($valTrait == "Penting"){
					    $trait = '<span class="badge badge-pill badge-soft-danger font-size-12">'.$valTrait.'</span>';
					} else{
					    $trait = '<span class="badge badge-pill badge-soft-primary font-size-12">'.$valTrait.'</span>';
					}

					$valStatus = $dim->InMailStatus;
          if($valStatus == 0){
            $status = '<span class="badge badge-pill badge-soft-danger font-size-12">Belum Diteruskan</span>';
          } elseif($valStatus == 1){
						$status = '<span class="badge badge-pill badge-soft-warning font-size-12">Diteruskan</span>';
					} else{
						$status = '<span class="badge badge-pill badge-soft-success font-size-12">Didisposisikan</span>';
					}

					$sub_array[] = '<p class="text-muted text-center mb-0"><b>'.$i++.'</b></p>';
					$sub_array[] = '<p class="text-truncate mb-0"><b>'.$dim->InMailOrigin.'</b></p>
													<p class="text-muted mb-0">'.$dim->InMailNumber.'</p>';
					$sub_array[] = '<p class="text-muted text-center mb-0">'.format_shortdateindo(date($dim->InMailDate)).'</p>';
					$sub_array[] = '<p class="text-muted text-center mb-0"><b>'.$dim->WorkunitName.'</b></p>';
					$sub_array[] = '<p class="text-truncate text-center mb-0">'.$dim->IndeksName.'</p>
													<p class="text-muted text-center mb-0">'.$trait.'</p>';
          $sub_array[] = '<p class="text-muted text-center mb-0">'.$status.'</p>';
					$sub_array[] = '<p class="text-muted text-center mb-0">'.$dim->FullName.'</p>';
          $sub_array[] = '<span class="text-center"><div class="dropdown">
															<a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
																	<i class="mdi mdi-dots-horizontal font-size-18"></i>
															</a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="'.base_url('disposition/detail/'.$dim->InMailID).'"><i class="fa fa-eye font-size-16 align-middle mr-2"></i>Lihat Rincian</a>
																<a class="dropdown-item" href="'.base_url('disposition/action/'.$dim->InMailID).'"><i class="fas fa-angle-double-right font-size-16 align-middle mr-2"></i>Disposisikan</a>
															</div>
														</span>';
					$data[] = $sub_array;
		 }
		 $output = array(
					"draw"             =>     intval($_POST["draw"]),
					"recordsTotal"     =>     $this->Disposition_model->get_all_datainmail(),
					"recordsFiltered"  =>     $this->Disposition_model->get_filtered_datainmail(),
					"data"             =>     $data,
		 );
		 header('Content-Type: application/json; charset=utf-8');
		 echo json_encode($output);
	}

  // ================================================================================================================= ACTION DISPOSITION

  function add_disposition($id){
		$this->db->where('Username', $this->input->post('input-Username'));
		$this->db->where('InMailID', $id);
		$countuser = $this->db->get('disposition')->num_rows();

    if ($countuser > 0) {
      $output = array(
        'Message' => 'no',
      );

      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($output);
    } else {
      $data1 = array(
        'InMailID' 	=> $id,
        'Username' => $this->input->post('input-Username'),
        'DispositionNote' 	=> (!empty($this->input->post('input-DispositionNote'))) ? $this->input->post('input-DispositionNote') : NULL,
        'DispositionDeadline' 	=> date('Y-m-d',strtotime($this->input->post('input-DispositionDeadline'))),
        'DispositionStatus' 	=> 'unread',
      );

			$insert_id = $this->Disposition_model->add_disposition($data1);

      $data2 = array(
        'InMailStatus' 	=> 2,
      );

			$data3 = array(
				'DispositionID' => $insert_id,
				'Username' => $this->session->userdata('Username'),
			);

      $output = array(
        'Message' => 'yes',
        'Update' => $this->Disposition_model->update_inmail($data2, $id),
				'Dispoted' => $this->Disposition_model->add_dispoted($data3)
      );

      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($output);
    }
  }

  function delete_disposition($id){
    $mailid = $this->db->get_where('disposition', ['DispositionID' => $id])->row()->InMailID;
    $countdis = $this->db->get_where('disposition', ['InMailID' => $mailid])->num_rows();

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->Disposition_model->delete_disposition($id));

    if ($countdis == 1) {
      $data = array(
        'InMailStatus' 	=> 1,
      );

      $this->Disposition_model->update_inmail($data, $mailid);
    }

  }

}
