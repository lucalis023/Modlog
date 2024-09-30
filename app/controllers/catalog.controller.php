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

  public function showPage($params = null) {
    $game = $this->gamesModel->getGameById($params[1]);
    if ($this->isNotEmpty($game)) {
      $this->setTittle($game->name);
      $this->setData('game', $game);

      $categories = $this->categoriesModel->getCategoriesByGame($game->id);
      $this->setData('categories', $categories);

      if (!empty($params[2])) {
        $mods = $this ->modsModel->getModsByGameAndCategory($params[1], $params[2]);
      } else {
        $mods = $this->modsModel->getModsByGame($game->id);
      }
      $this->setData('mods', $mods);
      
      $this->view->renderCatalog($this->data);
    }
  }
}