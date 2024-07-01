<?php

function checked_access($roleid,$menuid) {
  $ci = get_instance();

  $ci->db->where('RoleID',$roleid);
  $ci->db->where('GroupID',$menuid);
  $data = $ci->db->get('menuaccess');

  if($data->num_rows()>0){
      return "checked='checked'";
  }
}
