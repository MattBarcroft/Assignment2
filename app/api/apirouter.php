<?php
//https://www.leaseweb.com/labs/2015/10/creating-a-simple-rest-api-in-php/

$method = $_SERVER['REQUEST_METHOD'];

$baseUrl = $_SERVER['REQUEST_URI'];
$path = parse_url($baseUrl, PHP_URL_PATH);
$segments = explode('/', $path);

isset($segments[2]) ? $entity1 = strtolower($segments[2]) : $entity1 = null;
  
isset($segments[3]) ? $id = strtolower($segments[3]) : $id = null;

isset($segments[4]) ? $entity2 = strtolower($segments[4]) : $entity2 = null;

switch ($method) {
    case 'GET':
        include($_SERVER['DOCUMENT_ROOT'] . "/app/api/actions/GET.php");
        $get = new PUT($entity1, $id, $entity2);
        break;
    case 'PUT': 
        include($_SERVER['DOCUMENT_ROOT'] . "/app/api/actions/PUT.php");
        $put = new PUT($entity1, $id);
        break;
    case 'POST':
        include($_SERVER['DOCUMENT_ROOT'] . "/app/api/actions/POST.php");
        $post = new POST($entity1, $id);
        break;
    case 'DELETE':
        include($_SERVER['DOCUMENT_ROOT'] . "/app/api/actions/DELETE.php");
        $delete = new DELETE($entity1, $id);
        break;
  }
