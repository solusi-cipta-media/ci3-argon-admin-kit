<?php

/**
 * Ini merupakan cara untuk mempersingkat query datatable. 
 * Anda bisa menggunakan `->show_table()` untuk mendapatkan list data, dan anda bisa mengolah data sesuka anda.
 * Anda bisa menggunakan `->count_filtered()` untuk mencetak response `recordsFiltered`,
 * Anda bisa menggunakan `->count_all()` untuk menghasilkan response `recordsTotal`
 * 
 */
class DatatableQuery
{
  private $table;
  private $column_orderQ = [];
  private $column_searchQ = [];
  private $order = ['id' => 'desc'];
  private $selectQ;
  private $whereQ = [];
  private $joinq = [];
  private $group_byQ = [];
  private $likeQ = [];

  private $ci;
  private $db;

  function __construct()
  {
    $this->ci = &get_instance();
    $this->ci->load->database();
    $this->db = $this->ci->db;
  }

  private function _get_datatables_query($sum = null, string $sum_group_by = null)
  {
    if ($sum == null) {
      if ($this->selectQ != null) $this->db->select($this->selectQ);
    } else {
      $this->db->select($sum);
    }

    $this->db->from($this->table);
    foreach ($this->whereQ as $key => $value) {
      $this->db->where($key, $value);
    }

    foreach ($this->joinq as $key => $value) {
      $this->db->join($value[0], $value[1], isset($value[2]) ? $value[2] : "left");
    }

    foreach ($this->likeQ as $key => $value) {
      $this->db->like($key, $value);
    }

    $i = 0;

    foreach ($this->column_searchQ as $item) // loop column 
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

        if (count($this->column_searchQ) - 1 == $i) //last loop
          $this->db->group_end(); //close bracket
      }
      $i++;
    }

    if (isset($_POST['order'])) // here order processing
    {
      $this->db->order_by($this->column_orderQ[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;

      $this->db->order_by(key($order), $order[key($order)]);
    }

    foreach ($this->group_byQ as $key => $value) {
      $this->db->group_by($value);
    }

    if ($sum_group_by != null) {
      $this->db->group_by($sum_group_by);
    }
  }
  /**
   * ini merupakan query dimana anda mengambil datatable dari table apa.
   */
  public function from(string $table)
  {
    $this->table = $table;
  }

  /**
   * jika order == [] pada request datatable maka ini akan berfungsi sebagai default order
   */
  public function default_order(array $order = ['id' => 'desc'])
  {
    $this->order = $order;
  }

  /**
   * urutan column order, anda bisa mengisi dengan nama-nama column yang anda butuhkan,
   * contoh parameter:
   * ```PHP
   * ['id', 'nama']
   * ```
   */
  public function column_order(array $column_order)
  {
    $this->column_orderQ = $column_order;
  }

  /**
   * urutan column search, anda bisa mengisi dengan nama-nama column yang anda butuhkan,
   * contoh parameter:
   * ```PHP
   * ['id', 'nama']
   * ```
   */
  public function column_search(array $column_search)
  {
    $this->column_searchQ = $column_search;
  }


  /**
   * merupakan query `where`, jika list lebih dari 1 maka akan dilanjutkan dengan `AND` contoh parameter
   * ```php
   * [
   *  "id" => "1",
   *  "name" => "sukidi"
   * ]
   * ```
   * Maka akan menghasilkan query
   * ```sql
   * where id = 1 and name = sukidi
   * ```
   */
  public function where(array $where = [])
  {
    $this->whereQ = $where;
  }

  /**
   * contoh parameter sama dengan where
   */
  public function like(array $like = [])
  {
    $this->likeQ = $like;
  }

  /**
   * Merupakan query select seperti codeigniter, contoh
   * `*`
   * maka akan menghasilkan
   * ```sql
   * SELECT *
   * ```
   */
  public function select(string $select = "*")
  {
    $this->selectQ = $select;
  }

  /**
   * Merupakan query join, contoh parameter
   * ```php
   * [
   *    ["study_tbl st", "st.id = student.id_study", "left"],
   *    ["schedule_tbl sct", "sct.id = a.id_schedule", "left"]
   * ]
   * ```
   */
  public function join(array $join = [])
  {
    $this->joinq = $join;
  }

  /**
   * menghitung total yang sudah terfilter
   */
  public function count_filtered()
  {
    $this->_get_datatables_query();
    $query = $this->db->get();

    return $query->num_rows();
  }

  /**
   * contoh group by: `["nama", "id"]`
   */
  public function group_by(array $group_by = [])
  {
    $this->group_byQ = $group_by;
  }

  /**
   * menghitung semua total
   */
  public function count_all()
  {
    $this->db->from($this->table);

    return $this->db->count_all_results();
  }

  /**
   * mendapatkan list datatable
   */
  public function get_default()
  {
    $this->_get_datatables_query();
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }

  /**
   * digunakan untuk mengolah data urut dari kiri ke kanan. Jika anda menambahkan sesuatu bukan dengan nama kolom, maka sistem akan mendeteksi sebagai custom. jika anda menambahkan custom string, anda bisa menambahkan variable column dengan `:nama_column`, dan numbering dengan `{numbering}`
   */
  public function get_data_sort_by(array $column)
  {
    $this->_get_datatables_query();
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    $data = $query->result_array();

    $result = [];
    $no = @$_POST['start'];
    foreach ($data as $key => $value) {
      $no++;
      $row = [];
      foreach ($column as $k => $v) {
        if (isset($value[$v])) :
          $row[] = $value[$v];
        elseif ($v == "{numbering}") :
          $row[] = $no;
        elseif (str_contains($v, 'replace-data:')) :
          $row[] = $this->dt_str_replace($v, $value);
        else :
          $row[] = $this->dt_regex($v, $value);
        endif;
      }

      $result[] = $row;
    }

    return $result;
  }

  /**
   * untuk sumary bedasarkan filter datatable
   */
  public function get_sum_row(string $sum_select, string $sum_group_by)
  {
    $this->_get_datatables_query($sum_select, $sum_group_by);
    return $this->db->get()->row();
  }

  private function dt_str_replace($str, $value)
  {
    $data = explode("|", $str);
    $key = explode(":", $data[0])[1];

    $result = "";

    foreach ($data as $k => $v) {
      if (!str_contains($v, "replace-data:")) {
        $forif = explode("=", $v);
        if ($value[$key] == $forif[0]) {
          $result = $forif[1];
        }
      }
    }

    return $result;
  }

  private function dt_regex(string $v, array $value)
  {
    preg_match_all('/:([A-Z|a-z|0-9]+)/', $v, $matches);
    $q = $matches[0];
    $k = $matches[1];

    foreach ($q as $kmatch => $pmatch) {
      if (isset($value[$k[$kmatch]])) {
        $s = $value[$k[$kmatch]];
        $v = preg_replace("/" . $pmatch . "/i", $s, $v);
      }
    }

    return $v;
  }
}
