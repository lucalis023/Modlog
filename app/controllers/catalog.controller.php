<?php 
require_once __DIR__ . '/controllerTypes/ViewController.php';

class catalogController extends ViewController{
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
    parent::__construct(new catalogView, 'Catalog');
  }

  public function showCatalog($game_id) {
    $game = $this->gamesModel->getGameById($game_id);
    if ($this->isNotEmpty($game)) {
      $this->setTittle($game->name);
      $this->setData('game', $game);

      $mods = $this->modsModel->getModsByGame($game_id);
      $this->setData('mods', $mods);
      
      $this->view->renderCatalog($this->data);
    }
  }
}