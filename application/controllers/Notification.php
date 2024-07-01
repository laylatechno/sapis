<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

  public function __construct() {
    parent::__construct();
    error_reporting(0);
    $this->load->model('Notification_model');
  }

	public function index(){
    redirect(base_url('errorpage/not_found'));
	}

  // ================================================================================================================= INBOX NOTIFYCATION

  function count_inboxnotif() {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->Notification_model->count_inboxnotif());
  }

  public function set_notif($num) {
    $data = [
        'CountNotif' => $num,
    ];

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->session->set_userdata($data));
  }

  public function get_listnotif() {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->Notification_model->get_listnotif());
  }

  function maskasread($id){
    $data = array(
      'DispositionStatus' 	=> 'read',
    );

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->Notification_model->maskasread($data, $id));
  }

  // ================================================================================================================= DISPO NOTIFYCATION

  function count_disponotif() {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->Notification_model->count_disponotif());
  }

  public function set_dispo($num) {
    $data = [
        'CountDispo' => $num,
    ];

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->session->set_userdata($data));
  }

  public function get_listdispo() {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->Notification_model->get_listdispo());
  }

}
