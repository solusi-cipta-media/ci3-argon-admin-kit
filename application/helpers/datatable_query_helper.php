<?php

/**
 * Ini merupakan cara untuk mempersingkat query datatable. 
 * Anda bisa menggunakan `->show_table()` untuk mendapatkan list data, dan anda bisa mengolah data sesuka anda.
 * Anda bisa menggunakan `->count_filtered()` untuk mencetak response `recordsFiltered`,
 * Anda bisa menggunakan `->count_all()` untuk menghasilkan response `recordsTotal`
 * 
 */
class DatatableQuery extends CI_Model
{
  var $table;
  var $column;
  var $order;
  var $select;
  var $where;
  var $joinq;
  var $group_by;
  var $like;

  function __construct(
    string $table,
    array $column_order = [],
    array $default_order = array('user.id' => 'desc'),
    string $select = null,
    array $join = [],
    array $where = [],
    array $like = [],
    string $group_by = null,
  ) {
    $this->table = $table;
    $this->column = $column_order;
    if ($default_order != null) {
      $this->order = $default_order;
    }
    $this->select = $select;
    $this->where = $where;
    $this->joinq = $join;
    $this->group_by = $group_by;
    $this->like = $like;

    parent::__construct('user', 'id');
  }

  private function _get_datatables_query()
  {
    if ($this->select != null) $this->db->select($this->select);
    $this->db->from($this->table);
    foreach ($this->where as $key => $value) {
      $this->db->where($value);
    }

    foreach ($this->joinq as $key => $value) {
      $this->db->join($value);
    }

    foreach ($this->like as $key => $value) {
      $this->db->join($value);
    }

    $i = 0;

    foreach ($this->column as $item) // loop column 
    {
      if ($_POST['search']['value']) // if datatable send POST for search
      {

        if ($i === 0) // first loop
        {
          $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. 
          $this->db->like($item, $_POST['search']['value']);
        } else {
          $this->db->or_like($item, $_POST['search']['value']);
        }

        if (count($this->column) - 1 == $i) //last loop
          $this->db->group_end(); //close bracket
      }
      $column[$i] = $item; // set column array variable to order processing
      $i++;
    }

    if (isset($_POST['order'])) // here order processing
    {
      $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;

      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  public function count_filtered()
  {
    $this->_get_datatables_query();
    $query = $this->db->get();

    return $query->num_rows();
  }
  public function count_all()
  {
    $this->db->from($this->table);

    return $this->db->count_all_results();
  }

  public function show_table()
  {
    $this->_get_datatables_query();
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }
}
