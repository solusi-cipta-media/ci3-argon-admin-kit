<?php

use Dotenv\Dotenv;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class SCM_Controller extends CI_Controller
{
  var $req;
  var $res;
  var $dt;
  var $dq;
  function __construct()
  {
    parent::__construct();
    $this->load->helper("request");
    $this->load->helper("response");
    $this->load->helper("datatable_query");
    $this->load->helper('query_db');
    $this->load->helper("date_indo");
    $this->req = new RequestHelper();
    $this->res = new ResponseHelper();
    $this->dt = new DatatableQuery();
    $this->dq = new QueryDBHelper();
    $dotenv = Dotenv::createImmutable(FCPATH);
    $dotenv->load();
  }

  function backendUrl($path)
  {
    return $_ENV['BACKEND_URL'] . $path;
  }

  function jwtEncode($user_id)
  {
    return JWT::encode($user_id, $_ENV['APP_JWTKEY'], 'HS256');
  }

  function jwtDecode($jwt)
  {
    return JWT::decode($jwt, new Key($_ENV['APP_JWTKEY'], 'HS256'));
  }
}

class SCM_Auth extends SCM_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->_prevent_login();
  }

  function _prevent_login(): void
  {
    if (!$this->_is_user_login()) {
      redirect(base_url("auth/login"));
    }
  }

  function _is_user_login(): bool
  {
    $data = $this->_get_user_login();
    if ($data) return true;
    else return false;
  }

  function _get_user_login()
  {
    return $this->session->userdata("user_appsens_lite");
  }

  function headerJWTWithJson()
  {
    return [
      'Content-Type: application/json',
      "jwt:" . $this->_get_user_login()->jwt,
      "deviceId: website"
    ];
  }
}
