<?php
require_once '../config/base_url.php';
require_once '../config/db.php';

$action = 'games';

if (!empty($_GET['action'])) {
  $action = $_GET['action'];
}

try {
  $params = explode("/", $action);

  switch ($params[0]) {
    case 'games': 
      require_once '../app/controllers/games.controller.php';
      $controller = new gamesController;
      $controller->showGames();
      break;

    case 'catalog':
      if (!isset($params[1])) throw new Exception("Missing parameters.");
      require_once '../app/controllers/catalog.controller.php';
      $controller = new catalogController;
      $controller->showCatalog($params[1]);
      break;

    case 'mod':
      if (!isset($params[1])) throw new Exception("Missing parameters.");
      require_once '../app/controllers/modpage.controller.php';
      $controller = new modpageController;
      $controller->showMod($params[1]);
      break;

    case 'creator':
      if (!isset($params[1])) throw new Exception("Missing parameters.");
      require_once '../app/controllers/creator.controller.php';
      $controller = new creatorController;
      $controller->showCreator($params[1]);
      break;

    default:
      header('Location: '. BASE_URL);
      require_once '../app/controllers/games.controller.php';
      $controller = new gamesController;
      $controller->showGames();
      break;
  }
} catch (Exception $err) {
  require_once '../app/controllers/error.controller.php';
  $controller = new errorController;
  $controller->handleError($err); 
}