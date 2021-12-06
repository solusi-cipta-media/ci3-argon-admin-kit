<?php
class ResponseHelper
{
  function json200($body)
  {
    exit(json_encode($body));
  }

  function json($code, $body)
  {
    http_response_code($code);
    exit(json_encode($body));
  }
}
