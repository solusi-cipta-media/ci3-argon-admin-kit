<?php
class SCM_Controller extends CI_Controller
{
  var $req;
  var $response;
  function __construct()
  {
    parent::__construct();
    $this->load->helper("request");
    $this->load->helper("response");
    $this->load->helper("datatable_query");
    $this->req = new RequestHelper();
    $this->response = new ResponseHelper();
  }

  function _datatableQ(
    string $table,
    array $column_order = [],
    array $default_order = array('user.id' => 'desc'),
    string $select = null,
    array $join = [],
    array $where = [],
    array $like = [],
    string $group_by = null,
  ): DatatableQuery {
    return new DatatableQuery(
      $table,
      $column_order,
      $default_order,
      $select,
      $join,
      $where,
      $like,
      $group_by,
    );
  }
}
