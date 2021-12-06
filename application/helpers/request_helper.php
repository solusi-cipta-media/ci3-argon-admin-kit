<?php
defined('BASEPATH') or exit("NGAWUR JON");

class RequestHelper
{
  private function req(String $url, array $header, String $method, mixed $body = null): ResponseObject
  {
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);


    curl_setopt($ch, CURLOPT_HEADER, true);

    $result = curl_exec($ch);

    curl_close($ch);

    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($result, 0, $header_size);
    $body = substr($result, $header_size);

    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    return new ResponseObject($header, $body, $http_code);
  }


  public function post(String $url, array $header, mixed $body): ResponseObject
  {
    return $this->req($url, $header, "POST", $body);
  }

  public function get(String $url, array $header): ResponseObject
  {
    return $this->req($url, $header, "GET");
  }

  public function put(String $url, array $header, mixed $body): ResponseObject
  {
    return $this->req($url, $header, "PUT", $body);
  }

  public function delete(String $url, array $header): ResponseObject
  {
    return $this->req($url, $header, "DELETE");
  }
}

class ResponseObject
{
  var $header;
  var $body;

  var $http_code;

  function __construct($header, $body, $http_code)
  {
    $this->header = $header;
    $this->body = $body;
    $this->http_code = $http_code;
  }
}
