<?php
class Login extends SCM_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("auth/M_login", "M_login");
  }

  public function index()
  {
    $this->load->view("auth/login");
  }

  public function submit()
  {
    $data = $this->input->post();
    $result = $this->M_login->submit($data['username'], $data['password']);
    if ($result) {
      unset($result->password);
      $this->session->set_userdata("user_login", $result);

      $this->response->json200("oke");
    } else $this->response->json(401, "login failed!");
  }
}
