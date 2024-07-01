<?php

class Profile extends CI_Controller {
	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->model('Userdata_model');
		$this->load->model('Users_model');
		is_logged_in_2();
	}

  	public function index(){
	    $data = [
	        'title' => 'SIPAS - '.$this->db->get_where('companysetting', ['CompanyID' => 1])->row()->CompanyName,
	        'userdata' => $this->Userdata_model->get_userdata($this->session->userdata('Username')),
	    ];

	    $this->load->view('back-end/template/header', $data);
	    $this->load->view('back-end/template/sidebar');
	    $this->load->view('back-end/profile');
	    $this->load->view('back-end/template/footer');
    }

    public function uploadImage($input_field_name, $username, $column) {
    $config['upload_path'] = './uploads/account/'.$username;
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['overwrite'] = TRUE;
    $config['file_name'] = random_string('alnum', 50);
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if ( !$this->upload->do_upload($input_field_name, $username, $column)){
        $error = array('error' => $this->upload->display_errors());
    }else{
        $data = $this->upload->data();

        $this->Users_model->uploadImage($username, $column, $data['file_name']);

        //Compress Image
        $config['image_library'] = 'gd2';
        $config['source_image'] = './uploads/account/'.$username.'/'.$data['file_name'];
        $config['create_thumb']= FALSE;
        $config['maintain_ratio']= TRUE;
        $config['quality']= '80%';
        // $config['width']= 1920;
        // $config['height']= 500;
        $config['new_image']= './uploads/account/'.$username.'/'.$data['file_name'];
        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
    }
  }

  function get_userdata(){
    $username = $this->session->userdata('Username');
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->Userdata_model->get_userdata($username));
  }

  function edit_user(){
    $username = $this->session->userdata('Username');
    $data1 = array(
      'Email' => (!empty($this->input->post('input-Email'))) ? strtolower($this->input->post('input-Email')) : NULL,
    );

    $data2 = array(
      'FullName' => ucwords($this->input->post('input-FullName')),
      'Address' => (!empty($this->input->post('input-Alamat'))) ? $this->input->post('input-Alamat') : NULL,
      'Village' => (!empty($this->input->post('input-Kelurahan'))) ? ucwords($this->input->post('input-Kelurahan')) : NULL,
      'SubDistrict' => (!empty($this->input->post('input-Kecamatan'))) ? ucwords($this->input->post('input-Kecamatan')) : NULL,
      'District' => (!empty($this->input->post('input-Kota'))) ? ucwords($this->input->post('input-Kota')) : NULL,
      'State' => (!empty($this->input->post('input-Provinsi'))) ? ucwords($this->input->post('input-Provinsi')) : NULL,
      'ZIPCode' => (!empty($this->input->post('input-KodePOS'))) ? $this->input->post('input-KodePOS') : NULL,
      'POB' => (!empty($this->input->post('input-TempatLahir'))) ? ucwords($this->input->post('input-TempatLahir')) : NULL,
      'DOB' => (!empty($this->input->post('input-TanggalLahir'))) ? date('Y-m-d',strtotime($this->input->post('input-TanggalLahir'))) : NULL,
      'Gender' => (!empty($this->input->post('input-JenisKelamin'))) ? $this->input->post('input-JenisKelamin') : NULL,
      'Religion' => (!empty($this->input->post('input-Agama'))) ? $this->input->post('input-Agama') : NULL,
      'Phone' => (!empty($this->input->post('input-Telepon'))) ? $this->input->post('input-Telepon') : NULL,
    );

    $output = array(
      'update1' => $this->Users_model->edit_user1($data1, $username),
      'update2' => $this->Users_model->edit_user2($data2, $username),
    );

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($output);

    if (!empty($_FILES['file-input-imgprofile']['name'])) {
      $img_upload = $this->uploadImage('file-input-imgprofile', $username, 'AccountProfile');
    }
  }

  function change_imgcover(){
    $username = $this->session->userdata('Username');
		$imghas = $this->db->get_where('accountuser', ['Username' => $username])->row()->AccountCover;

		if (!$imghas) {
			// code...
		} else {
			unlink('./uploads/account/'.$this->session->userdata('Username').'/'.$imghas);
		}

    if (!empty($_FILES['img-input-cover']['name'])) {
      $img_upload = $this->uploadImage('img-input-cover', $username, 'AccountCover');
      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($img_upload);
    }
  }

	function delete_imgcover(){
		$query = $this->db->get_where('accountuser', ['Username' => $this->session->userdata('Username')])->row_array();

		$data = array(
      'AccountCover' => NULL,
    );

		$output = array(
			'DeleteFile' => unlink('./uploads/account/'.$this->session->userdata('Username').'/'.$query['AccountCover']),
			'DeleteColumn' => $this->Users_model->delete_imgcover($data, $this->session->userdata('Username'))
		);

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($output);
	}

	function change_imgprofile(){
		$username = $this->session->userdata('Username');
		$imghas = $this->db->get_where('accountuser', ['Username' => $username])->row()->AccountProfile;

		if (!$imghas) {
			// code...
		} else {
			unlink('./uploads/account/'.$this->session->userdata('Username').'/'.$imghas);
		}

		if (!empty($_FILES['img-input-profile']['name'])) {
			$img_upload = $this->uploadImage('img-input-profile', $username, 'AccountProfile');
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($img_upload);
		}
	}

	function delete_imgprofile(){
		$query = $this->db->get_where('accountuser', ['Username' => $this->session->userdata('Username')])->row_array();

		$data = array(
			'AccountProfile' => NULL,
		);

		$output = array(
			'DeleteFile' => unlink('./uploads/account/'.$this->session->userdata('Username').'/'.$query['AccountProfile']),
			'DeleteColumn' => $this->Users_model->delete_imgcover($data, $this->session->userdata('Username'))
		);

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($output);
	}

	function get_counter(){
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Userdata_model->get_counter());
	}

	function delete_loginhistory(){
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Userdata_model->delete_loginhistory());
	}

	public function password_change() {
		$username = $this->session->userdata('Username');

		$data = array(
			'Password'  => password_hash($this->input->post('input-Password'),PASSWORD_DEFAULT),
		);

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Users_model->password_change($data, $username));
	}

}
