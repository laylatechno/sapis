<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	function __construct(){
		parent::__construct();
		error_reporting(0);
    $this->load->model('Companydata_model');
		$this->load->model('Userdata_model');
		$this->load->model('Users_model');
		is_logged_in();
	}

	function index() {
		$data = [
				'title' => 'SIPAS - '.$this->db->get_where('companysetting', ['CompanyID' => 1])->row()->CompanyName,
				'userdata' => $this->Userdata_model->get_userdata($this->session->userdata('Username')),
		];

    $this->load->view('back-end/template/header', $data);
    $this->load->view('back-end/template/sidebar');
    $this->load->view('back-end/users');
    $this->load->view('back-end/template/footer');
	}

  public function grant($roleid){
		$data = [
				'title' => 'SIPAS - '.$this->db->get_where('companysetting', ['CompanyID' => 1])->row()->CompanyName,
				'userdata' => $this->Userdata_model->get_userdata($this->session->userdata('Username')),
		];

		$this->load->view('back-end/template/header', $data);
		$this->load->view('back-end/template/sidebar');
		$this->load->view('back-end/users');
		$this->load->view('back-end/template/footer');
	}

	function get_datacounter(){
		$output = array(
			'TotalUser' => $this->db->get('accountuser')->num_rows(),
			'TotalRole' => $this->db->get('rolemaster')->num_rows(),
			'TotalClassification' => $this->db->get('workunit')->num_rows(),
		);
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($output);
	}

	// ============================================================================================ HAK AKSES

  function get_dataaccess(){
    $dataaccess = $this->Users_model->get_dataaccess();
    foreach($dataaccess as $da){
      echo '<tr>
                <td style="width: 45px;">
                    <div class="avatar-sm">
                        <span class="avatar-title rounded-circle bg-soft-'.$da->RoleColor.' text-'.$da->RoleColor.' font-size-24">
                            <i class="mdi mdi-account-star-outline"></i>
                        </span>
                    </div>
                </td>
                <td><a href="javascript:void(0)" class="text-dark" onclick="method_editaccess(\''.$da->RoleID.'\')"><strong>'.$da->RoleName.'</strong></a></td>
                <td text-center">
                  <div class="spinner-grow text-'.$da->RoleColor.' m-1" role="status">
                      <span class="sr-only">Loading...</span>
                  </div>
                </td>
                <td>
                    <div class="text-center">
                        <a href="'.base_url('users/grant/'.$da->RoleID).'" class="text-info font-size-18"><i class="bx bx-cog"></i></a>
                    </div>
                </td>
            </tr>';
    }
    exit;
  }

  function get_viewaccess($id){
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->Users_model->get_viewaccess($id));
  }

  public function edit_access($id) {
    $data = [
        'RoleName' => ucwords($this->input->post('input-RoleName')),
        'RoleColor' => $this->input->post('input-RoleColor'),
    ];

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->Users_model->edit_access($data, $id));
  }

  function grant_access(){
      $menuid = $_GET['menuid'];
      $roleid	= $_GET['roleid'];

      $params = array('GroupID'=>$menuid,'RoleID'=>$roleid);
      $access = $this->db->get_where('menuaccess',$params);
      if($access->num_rows() < 1){
          $this->db->insert('menuaccess',$params);
      }else{
          $this->db->where('GroupID',$menuid);
          $this->db->where('RoleID',$roleid);
          $this->db->delete('menuaccess');
      }
  }

	// ============================================================================================ USERS

  function get_userlist(){
    $page =  $_GET['page'];
    $datauserlist = $this->Users_model->get_userlist($page)->result();
    foreach($datauserlist as $dul){
      echo '<div class="col-xl-3 col-sm-6">
              <div class="card text-center">
                <div class="card-body">
                  <div class="avatar-md mx-auto mb-4">';
			if (!$dul->AccountProfile) {
				echo '<img src="'.base_url('uploads/account/default/picprofile.jpg').'" class="img-thumbnail rounded-circle" alt="img">';
			} else {
				echo '<img src="'.base_url('uploads/account/'.$dul->Username.'/'.$dul->AccountProfile).'" class="img-thumbnail rounded-circle" alt="img">';
			}
      echo 				'</div>
                  <h5 class="font-size-15">'.$dul->FullName.'</h5>
                  @'.$dul->Username.' - <span class="badge badge-pill bg-soft-'.$dul->RoleColor.' text-'.$dul->RoleColor.' font-size-12">'.$dul->WorkunitName.'</span>
                  <p class="text-muted mt-2">';
			if (!$dul->Email) {
				echo '-';
			} else {
				echo $dul->Email;
			}
			echo '</p>
                </div>
                <div class="card-footer bg-transparent border-top">
                  <div class="contact-links d-flex font-size-20">
									<div class="flex-fill"><a href="javascript:void(0)" onclick="method_edit_user(\''.$dul->Username.'\');"><i class="bx bx-user-circle"></i></a></div>
                  <div class="flex-fill"><a href="javascript:void(0)" onclick="method_delete_user(\''.$dul->Username.'\');"><i class="bx bx-trash"></i></a></div>
                  </div>
                </div>
              </div>
            </div>';
    }
    exit;
  }

  function get_search(){
		$keyword =  $_GET['keyword'];
		$datauserlist = $this->Users_model->get_search($keyword)->result();
		foreach($datauserlist as $dul){
      echo '<div class="col-xl-3 col-sm-6">
              <div class="card text-center">
                <div class="card-body">
                  <div class="avatar-md mx-auto mb-4">';
			if (!$dul->AccountProfile) {
				echo '<img src="'.base_url('uploads/account/default/picprofile.jpg').'" class="img-thumbnail rounded-circle" alt="img">';
			} else {
				echo '<img src="'.base_url('uploads/account/'.$dul->Username.'/'.$dul->AccountProfile).'" class="img-thumbnail rounded-circle" alt="img">';
			}
      echo 				'</div>
                  <h5 class="font-size-15">'.$dul->FullName.'</h5>
                  @'.$dul->Username.' - <span class="badge badge-pill bg-soft-'.$dul->RoleColor.' text-'.$dul->RoleColor.' font-size-12">'.$dul->WorkunitName.'</span>
                  <p class="text-muted mt-2">';
			if (!$dul->Email) {
				echo '-';
			} else {
				echo $dul->Email;
			}
			echo '</p>
                </div>
                <div class="card-footer bg-transparent border-top">
                  <div class="contact-links d-flex font-size-20">
                  <div class="flex-fill"><a href="javascript:void(0)" onclick="method_edit_user(\''.$dul->Username.'\');"><i class="bx bx-user-circle"></i></a></div>
                  <div class="flex-fill"><a href="javascript:void(0)" onclick="method_delete_user(\''.$dul->Username.'\');"><i class="bx bx-trash"></i></a></div>
                  </div>
                </div>
              </div>
            </div>';
    }
		exit;
	}

	function get_viewuser($username){
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Users_model->get_viewuser($username)->row());
	}

  function check_duplicateid($username){
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->Users_model->check_duplicateid($username)->num_rows());
  }

  function add_user(){
    $username = strtolower($this->input->post('input-Username'));

    $data1 = array(
      'Username' 	=> $username,
      'Password' 	=> password_hash('123456',PASSWORD_DEFAULT),
      'Email' => (!empty($this->input->post('input-Email'))) ? strtolower($this->input->post('input-Email')) : NULL,
      'RoleID' 	=> $this->input->post('input-user-RoleID'),
      'AccountStatus' 	=> $this->input->post('input-ActiveStatus'),
    );

    $data2 = array(
      'Username' 	=> $username,
      'WorkunitID' 	=> $this->input->post('input-WorkunitID'),
      'FullName' 	=> ucwords($this->input->post('input-FullName')),
    );

		$output = array(
      'insertuser' 	=> $this->Users_model->add_user1($data1),
      'insertinfo' 	=> $this->Users_model->add_user2($data2),
      'makedir' 	=> mkdir('./uploads/account/'.$username, 0777, TRUE),
    );

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($output);
  }

  function edit_user($username){
    $data1 = array(
      'Email' => (!empty($this->input->post('input-Email'))) ? strtolower($this->input->post('input-Email')) : NULL,
      'RoleID' 	=> $this->input->post('input-user-RoleID'),
      'AccountStatus' 	=> $this->input->post('input-ActiveStatus'),
    );

    $data2 = array(
      'WorkunitID' 	=> $this->input->post('input-WorkunitID'),
      'FullName' 	=> ucwords($this->input->post('input-FullName')),
    );

    $output = array(
      'updateuser' => $this->Users_model->edit_user1($data1, $username),
      'updateinfo' => $this->Users_model->edit_user2($data2, $username),
    );

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($output);
  }

  function delete_user($username){
    if (is_dir('uploads/account/'.$username)) {
      delete_files('./uploads/account/'.$username, TRUE);
      rmdir('./uploads/account/'.$username);
    } else {
      // code...
    }

		$output = array(
			'DeleteUser' => $this->Users_model->delete_user($username),
			'DeleteInfo' => $this->Users_model->delete_info($username),
		);

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($output);
  }

}
