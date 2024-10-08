<?php
session_start();
require_once './config/base_url.php';
require_once './config/db.php';
require_once './routes/router.php';

$action = 'games';
if (!empty($_GET['action'])) {
  $action = $_GET['action'];
}

$router = new Router();

//Normal routes
$router->addRoute('games', 'games', 'showPage');
$router->addRoute('catalog/:id', 'catalog', 'showPage');
$router->addRoute('catalog/:id/:category', 'catalog', 'showPage');
$router->addRoute('modpage/:id', 'modpage', 'showPage');
$router->addRoute('creators', 'creators', 'showCreators');
$router->addRoute('creator/:id', 'creators', 'showCreator');
$router->addRoute('login', 'login', 'handleLogin');
$router->addRoute('logout', 'login', 'handleLogout');
$router->addRoute('register', 'login', 'handleRegister');

//Admin
$router->addRoute('admin/game/:id', 'admin', 'handleGame');
$router->addRoute('admin/game/delete/:id', 'admin', 'deleteGame');
$router->addRoute('admin/category/delete/:id', 'admin', 'deleteCategory');
$router->addRoute('admin/category/:game/:id', 'admin', 'handleCategory');
$router->addRoute('admin/creator/:id', 'admin', 'handleCreator');
$router->addRoute('admin/creator/delete/:id', 'admin', 'deleteCreator');
$router->addRoute('admin/mod/delete/:id', 'admin', 'deleteMod');
$router->addRoute('admin/mod/:game/:id', 'admin', 'handleMod');


$router->route($action);