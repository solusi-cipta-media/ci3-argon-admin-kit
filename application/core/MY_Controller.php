<?php
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
    $this->req = new RequestHelper();
    $this->res = new ResponseHelper();
    $this->dt = new DatatableQuery();
    $this->dq = new QueryDBHelper();
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
    return $this->session->userdata("user_login");
  }
}
