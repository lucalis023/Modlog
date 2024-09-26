<?php 
require_once __DIR__ . '/Controller.php';

class catalogController extends Controller {
  
  public function __construct() {
    require_once dirname(__DIR__, 1) . '/models/catalog.model.php';
    require_once dirname(__DIR__, 1) . '/views/catalog.view.php';
    parent::__construct(new catalogModel, new catalogView);
  }

  public function showCatalog($game_id) {
    $game = $this->model->getGame($game_id);
    if (!empty($game)) {
      $mods = $this->model->getMods($game_id);
      $this->view->showCatalog($game, $mods);
    } else {
      echo 'Game not found';
    }
  }
}