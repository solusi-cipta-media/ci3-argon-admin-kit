<?php
class Users extends SCM_Auth
{
  function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    $this->load->view("master/users");
  }
}
