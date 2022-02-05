<?php

class M_login extends CI_Model
{
  function submit($username, $password)
  {
    $this->db->from('mst_users');
    $this->db->group_start(); // open bracket.
    $this->db->where('username', $username);
    $this->db->or_where('email', $username);
    $this->db->group_end(); //close bracket

    $this->db->where('password', md5($password));

    $result = $this->db->get()->row();
    return $result;
  }
}
