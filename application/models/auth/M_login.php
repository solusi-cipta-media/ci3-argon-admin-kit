<?php

class M_login extends CI_Model
{
  function submit($username, $password)
  {
    $result = $this->db->get_where("user", [
      "username" => $username,
      "password" => md5($password)
    ])->row();
    return $result;
  }
}
