<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  function is_logged_in() {
    $ci = get_instance();
    if (!$ci->session->userdata('Username') || !$ci->session->userdata('Logged_IN') == TRUE) {
      redirect('auth');
    } else {
      $roleid = $ci->session->userdata('RoleID');
      $currenturl = $ci->uri->segment(1);

      $querygroup = $ci->db->get_where('menumaster', ['MenuLink' => $currenturl])->row_array();
      $groupid = $querygroup['GroupID'];

      $useraccess = $ci->db->get_where('menuaccess', [
          'RoleID' => $roleid,
          'GroupID' => $groupid,
      ]);

      if ($useraccess->num_rows() < 1) {
        redirect('errorpage/not_acceptable');
      }

    }
  }

  function is_logged_in_2() {
    $ci = get_instance();
    if (!$ci->session->userdata('Username') || !$ci->session->userdata('Logged_IN') == TRUE) {
      redirect('auth');
    } else {

    }
  }
