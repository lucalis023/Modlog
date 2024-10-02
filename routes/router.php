<?php
require_once '../config/base_url.php';
require_once '../config/db.php';
require_once './routes.php';

$action = 'games';
session_start();

if (!empty($_GET['action'])) {
  $action = $_GET['action'];
}

try {
  $params = explode("/", $action);
  if(!key_exists($params[0], $routes)){
    header('Location: '. BASE_URL);
  } 
  loadPage($params, $routes);

} catch (Exception $err) {
  require_once '../app/controllers/error.controller.php';
  $controller = new errorController;
  $controller->handleError($err); 
}


function loadPage($params, $routes) {
    require_once $routes[$params[0]]['controller'];
    $className = $routes[$params[0]]['class'];
    $controller = new $className;
    $controller->showPage($params);
}