<?php

class Dashboard extends SCM_Auth
{
  function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    $this->load->view("dashboard");
  }
}
