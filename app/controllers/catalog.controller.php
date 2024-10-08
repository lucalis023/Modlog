<?php 
require_once './app/controllers/controllerTypes/ViewController.php';

class catalogController extends ViewController{
  protected $gamesModel;
  protected $modsModel;
  protected $categoriesModel;

  public function __construct() {
    require_once './app/models/games.model.php';
    $this->gamesModel = new gamesModel; 
    require_once './app/models/mods.model.php';
    $this->modsModel = new modsModel;
    require_once './app/models/categories.model.php';
    $this->categoriesModel = new categoriesModel;
    require_once './app/views/catalog.view.php';
    parent::__construct(new catalogView, 'Catalog');
  }

  public function showPage($params) {
    $game = $this->gamesModel->getGameById($params['id']);
    if ($this->isNotEmpty($game)) {
      $this->setTittle($game->name);
      $this->setData('game', $game);

      $categories = $this->categoriesModel->getCategoriesByGame($game->id);
      $this->setData('categories', $categories);

      if (!empty($params['category'])) {
        $mods = $this ->modsModel->getModsByGameAndCategory($params['id'], $params['category']);
      } else {
        $mods = $this->modsModel->getModsByGame($game->id);
      }
      $this->setData('mods', $mods);
      
      $this->view->renderCatalog($this->data);
    }
  }
}