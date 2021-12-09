<?php

class QueryDBHelper
{
  private $ci;
  private $db;
  function __construct()
  {
    $this->ci = &get_instance();
    $this->ci->load->database();
    $this->db = $this->ci->db;
  }

  function where($column, $value)
  {
    return $this->db->where($column, $value);
  }

  function get($table = null)
  {
    if ($table == null) return $this->db->get();
    else return $this->db->get($table);
  }

  function get_row($table)
  {
    return $this->get($table)->row();
  }

  function get_row_array($table)
  {
    return $this->get($table)->row_array();
  }

  function get_result($table)
  {
    return $this->get($table)->result();
  }

  function get_result_array($table)
  {
    return $this->get($table)->result_array();
  }

  function get_where(string $table, array $where)
  {
    return $this->db->get_where($table, $where);
  }

  function get_where_row(string $table, array $where)
  {
    return $this->get_where($table, $where)->row();
  }

  function get_where_row_array(string $table, array $where)
  {
    return $this->get_where($table, $where)->row_array();
  }

  function get_where_result(string $table, array $where)
  {
    return $this->get_where($table, $where)->result();
  }

  function get_where_result_array(string $table, array $where)
  {
    return $this->get_where($table, $where)->result_array();
  }
}
