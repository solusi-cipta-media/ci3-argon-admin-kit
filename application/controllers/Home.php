<?php

class Home extends SCM_Auth
{
  function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    $this->load->view("template/layout");
  }
}
