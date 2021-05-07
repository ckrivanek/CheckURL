<?php

require_once(__DIR__ . "/../controllers/ControllerRequest.php");
require_once(__DIR__ . "/../controllers/URLController.php");

$method = strtolower($_SERVER["REQUEST_METHOD"]);
$path = explode("/", $_SERVER["REQUEST_URI"]);
//print($_SERVER["REQUEST_URI"]);
//print($_SERVER["REQUEST_METHOD"]);
$resource = $path[3];
//print ($resource);
//print ($method);
$controller = ucfirst($resource) . "Controller";

if (method_exists($controller, $method)) {
  header("Content-Type: application/json");
  $data = json_decode(file_get_contents("php://input"));
  $request = new ControllerRequest();
  if ($method == "get" || $method == "put" || $method == "delete" || $method == "patch") {
    $request->id = $path[4];
    $request->param = $path[5];
  }
  if ($method == "post" || $method == "put" || $method == "patch") {
    $request->data = $data;
  }
  $response = call_user_func(array($controller, $method), $request);
  echo json_encode($response);
}
else {
  http_response_code(405);
}


