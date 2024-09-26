<?php

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
    echo 'Catalog';
    break;
}