<?php

/**
 * this `helper` build by [gilang pratama](https://gepcode.com).    
 * this helper used to convert `mysql` to `indonesian` DateTime time format, you can also use it to convert from `indonesian` format to `mysql` format. **BE CAREFUL**, when you set the `$DateTime` parameter as an `indonesian` format you only can use it to format to `mysql` format or vice versa. Thanks
 */
class DateTimeIndo
{
  public $DateTime;
  public function __construct($DateTime)
  {
    $this->DateTime = $DateTime;
  }

  var $short_month = [
    'Jan', //1
    'Feb', //2
    'Mar', //3
    'Apr', //4
    'Mei', //5
    'Jun', //6
    'Jul', //7
    'Ags', //8
    'Sep', //9
    'Okt', //10
    'Nov', //11
    'Des' //12
  ];

  var $long_month = [
    'Januari', //1
    'Februari', //2
    'Maret', //3
    'April', //4
    'Mei', //5
    'Juni', //6
    'Juli', //7
    'Agustus', //8
    'September', //9
    'Oktober', //10
    'November', //11
    'Desember' //12
  ];

  private function parseMysql()
  {
    $exploded = explode(" ", $this->DateTime);
    if (count($exploded) < 1) throw new Exception("Invalid format mysql", 1);

    $time = isset($exploded[1]) ? $exploded[1] : "00:00:00";
    $date = $exploded[0];

    $date_exploded = explode("-", $date);

    if (count($date_exploded) < 3) throw new Exception("Invalid format mysql", 1);

    $time_exploded = explode(":", $time);

    return [
      "year" => $date_exploded[0],
      "month" => $date_exploded[1],
      "day" => $date_exploded[2],
      "hour" => $time_exploded[0],
      "minute" => $time_exploded[1],
      "second" => $time_exploded[2],
    ];
  }

  private function parseIndo()
  {
    $check = $this->checkIndoFormat();
    if ($check == "slash") return $this->parseIndoSlash();
    elseif ($check == "short_month") return $this->parseAlphabetMonth("short");
    elseif ($check == "long_month") return $this->parseAlphabetMonth("long");
  }

  private function parseIndoSlash()
  {
    $exploded = explode(" ", $this->DateTime);
    $time = isset($exploded[1]) ? $exploded[1] : "00:00:00";
    $date = $exploded[0];

    $date_exploded = explode("/", $date);
    if (count($date_exploded) < 3) throw new Exception("Invalid indonesian format", 1);
    $time_exploded = explode(":", $time);

    return [
      "year" => $date_exploded[2],
      "month" => $date_exploded[1],
      "day" => $date_exploded[0],
      "hour" => $time_exploded[0],
      "minute" => $time_exploded[1],
      "second" => $time_exploded[2],
    ];
  }

  private function parseAlphabetMonth($type)
  {
    $exploded = explode(" ", $this->DateTime);
    if (count($exploded) < 3) throw new Exception("Invalid indonesian short month format", 1);
    if (!in_array($exploded[1], $this->short_month)) throw new Exception("Invalid indonesian short month format", 1);
    return [
      "year" => $exploded[0],
      "month" => $type == "short" ? (array_search($exploded[1], $this->short_month) + 1) : (array_search($exploded[1], $this->long_month) + 1),
      "day" => $exploded[2],
      "hour" => isset($exploded[3]) ? $exploded[3] : "00",
      "minute" => isset($exploded[4]) ? $exploded[4] : "00",
      "second" => isset($exploded[5]) ? $exploded[5] : "00"
    ];
  }

  private function checkIndoFormat()
  {
    $exploded = explode("/", $this->DateTime);
    if (count($exploded) > 1) return "slash";

    $exploded = explode(" ", $this->DateTime);
    if (in_array($exploded[1], $this->short_month)) return "short_month";
    elseif (in_array($exploded[1], $this->long_month)) return "long_month";
    else throw new Exception("Invalid format", 1);
  }

  private function m()
  {
    $key = intval($this->parseMysql()["month"]) - 1 < 0 ? 0 : intval($this->parseMysql()["month"]) - 1;
    return $this->short_month[$key];
  }

  private function month()
  {
    $key = intval($this->parseMysql()["month"]) - 1 < 0 ? 0 : intval($this->parseMysql()["month"]) - 1;
    return $this->long_month[$key];
  }

  public function dmyyyy()
  {
    $arr = $this->parseMysql();
    return $arr['day'] . " " . $this->m() . " " . $arr['year'];
  }

  public function dmmyyyy()
  {
    $arr = $this->parseMysql();
    return $arr['day'] . " " . $this->month() . " " . $arr['year'];
  }

  public function dmy()
  {
    $arr = $this->parseMysql();
    return $arr['day'] . "/" . $arr['month'] . "/" . $arr["year"];
  }

  public function to_mysql_date()
  {
    $data = $this->parseIndo();
    return $data["year"] . "-" . $data["month"] . "-" . $data["day"];
  }
}

function dateIndo($date)
{
  return new DateTimeIndo($date);
}
