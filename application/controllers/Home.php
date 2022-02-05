<?php

class Home extends SCM_Auth
{
  function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    $user_id = $this->_get_user_login()->user_id;
    $data['user'] = $this->dq->get_where_row('mst_users', ['user_id' => $user_id]);
    $this->load->view("template/layout", $data);
  }
}
