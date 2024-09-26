<?php
require_once '../config/base_url.php';

$action = 'games';

if (!empty($_GET['action'])) {
  $action = $_GET['action'];
}

$params = explode("/", $action);

switch ($params[0]) {
  case 'games': 
    require_once '../app/controllers/games.controller.php';
    $controller = new gamesController;
    $controller->showGames();
    break;
  case 'catalog':
    require_once '../app/controllers/catalog.controller.php';
    $controller = new catalogController;
    $controller->showCatalog($params[1]);
    break;
}