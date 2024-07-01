<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

  public function __construct() {
    parent::__construct();
    error_reporting(0);
    $this->load->model('Companydata_model');
  }

	public function index(){
    $data = [
        'title' => 'SIPAS - '.$this->db->get_where('companysetting', ['CompanyID' => 1])->row()->CompanyName,
        'companydata' => $this->Companydata_model->get_companydata(),
    ];

    $this->load->view('login-page/template/header', $data);
    $this->load->view('login-page/auth');
    $this->load->view('login-page/template/footer');
	}

  // ========================================================================================================================== VALIDATION LOGIN ===========================================================================================================

    public function validation_auth() {
      $username = $this->input->post('input-Username', true);
      $password = $this->input->post('input-Password', true);

      $this->db->where('accountuser.Username', $username);
      $this->db->join('accountinfo', 'accountinfo.Username = accountuser.Username');
      $userdata = $this->db->get('accountuser')->row_array();
      $roledata = $this->db->get_where('rolemaster', ['rolemaster.RoleID' => $userdata['RoleID']])->row_array();

      if ($userdata) {
          if ($userdata['AccountStatus'] == 'yes') {
              if (password_verify($password, $userdata['Password'])){
                  $data = [
                      'Username' => $userdata['Username'],
                      'Email' => $userdata['Email'],
                      'FullName' => $userdata['FullName'],
                      'RoleID' => $userdata['RoleID'],
                      'RoleName' => $roledata['RoleName'],
                      'Logged_IN' => TRUE,
                      'Welcome' => TRUE,
                  ];

                  $this->session->set_userdata($data);
                  if ($roledata['RoleID'] > 0) {
                      redirect('dashboard');
                  } else {
                      $this->session->sess_destroy();
                      redirect('errorpage/not_acceptable');
                  }
              } else {
                  echo $this->session->set_flashdata('flash', '<b>401 Unauthorized</b> <br>Kata sandi yang Anda gunakan tidak benar');
                  echo $this->session->set_flashdata('type', 'warning');
                  redirect('auth');
              }
          } else {
              echo $this->session->set_flashdata('flash', '<b>401 Unauthorized</b> <br>Status akun Anda tidak aktif, silahkan hubungi Administrator');
              echo $this->session->set_flashdata('type', 'warning');
              redirect('auth');
          }
      } else {
          echo $this->session->set_flashdata('flash', '<b>410 Not Available</b> <br>Akun yang Anda gunakan tidak terdaftar atau tidak ada');
          echo $this->session->set_flashdata('type', 'error');
          redirect('auth');
      }
    }

    // ========================================================================================================================== LOGOUT ===========================================================================================================

    public function destroy_login() {
      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($this->session->sess_destroy());
    }

}
