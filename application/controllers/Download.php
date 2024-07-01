<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {
	function __construct(){
		parent::__construct();
		error_reporting(0);
    is_logged_in_2();
	}

	function index() {
		redirect(base_url('errorpage/not_found'));
	}

	function incoming_mail($filename) {
    $query = $this->db->get_where('inmailattachment', ['AttachmentFile' => $filename])->row();
    $path = 'uploads/file/incoming-mail/'.$query->InMailID.'/'.$filename;
    $extension = explode('.', $query->AttachmentFile);
    $newfilename = $query->AttachmentName.'.'.$extension[1];

    force_download($newfilename,file_get_contents($path));
	}

  function outgoing_mail($filename) {
    $query = $this->db->get_where('outmailattachment', ['AttachmentFile' => $filename])->row();
    $path = 'uploads/file/outgoing-mail/'.$query->OutMailID.'/'.$filename;
    $extension = explode('.', $query->AttachmentFile);
    $newfilename = $query->AttachmentName.'.'.$extension[1];

    force_download($newfilename,file_get_contents($path));
	}

}
