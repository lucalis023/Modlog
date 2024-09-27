<?php 

class catalogController {
  protected $view;
  protected $gamesModel;
  protected $modsModel;
  protected $categoriesModel;

  public function __construct() {
    require_once dirname(__DIR__, 1) . '/models/games.model.php';
    $this->gamesModel = new gamesModel;
    require_once dirname(__DIR__, 1) . '/models/mods.model.php';
    $this->modsModel = new modsModel;
    require_once dirname(__DIR__, 1) . '/models/categories.model.php';
    $this->categoriesModel = new categoriesModel;
    require_once dirname(__DIR__, 1) . '/views/catalog.view.php';
    $this->view = new catalogView;
  }

  public function showCatalog($game_id) {
    $game = $this->gamesModel->getGameById($game_id);
    if (!empty($game)) {
      $mods = $this->modsModel->getModsByGame($game_id);
      $this->view->showCatalog($game, $mods);
    } else {
      echo 'Game not found';
    }
  }
}