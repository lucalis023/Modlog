<?php
require_once '../config/base_url.php';
require_once '../config/db.php';

$action = 'games';

if (!empty($_GET['action'])) {
  $action = $_GET['action'];
}

session_start();

try {
  $params = explode("/", $action);
  loadPage($params);

} catch (Exception $err) {
  require_once '../app/controllers/error.controller.php';
  $controller = new errorController;
  $controller->handleError($err); 
}


function loadPage($params) {
  try {
    require_once '../app/controllers/' . $params[0] . '.controller.php';
    $className = $params[0] . 'Controller';
    $controller = new $className;
    $controller->showPage($params);

  } catch (Error $e) {
    header('Location: '. BASE_URL);
    require_once '../app/controllers/games.controller.php';
    $controller = new gamesController;
    $controller->showPage($params);
  }
}