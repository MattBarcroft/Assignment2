<?php

$status = http_response_code();
switch ($status) {
  case '400':
   echo 'Custom error 400';
  break;
  case '404':
   echo 'Custom error 404';
  break;
  
}

include("app/config/init.php");



?>