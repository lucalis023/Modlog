<?php 
require_once __DIR__ . '/controllerTypes/ViewController.php';

class modpageController extends ViewController {
  protected $modsModel;
  protected $gamesModel;
  protected $creatorsModel;
  protected $categoriesModel;

  public function __construct() {
    require_once dirname(__DIR__, 1) . '/models/games.model.php';
    $this->gamesModel = new gamesModel;
    require_once dirname(__DIR__, 1) . '/models/mods.model.php';
    $this->modsModel = new modsModel;
    require_once dirname(__DIR__, 1) . '/models/creators.model.php';
    $this->creatorsModel = new creatorsModel;
    require_once dirname(__DIR__, 1) . '/models/categories.model.php';
    $this->categoriesModel = new categoriesModel;
    require_once dirname(__DIR__, 1) . '/views/modpage.view.php';
    parent::__construct(new modpageView, 'Modpage');
  }

  public function showPage($params = null) {
    $mod = $this->modsModel->getModById($params[1]);
    if ($this->isNotEmpty($mod)){
      $this->setTittle($mod->name);
      $this->setData('mod', $mod);

      $creator = $this->creatorsModel->getCreatorById($mod->creator_id);
      $this->setData('creator', $creator);

      $game = $this->gamesModel->getGameById($mod->game_id);
      $this->setData('game', $game);

      $category = $this->categoriesModel->getCategoryById($mod->category_id);
      $this->setData('category', $category);
      
      $this->view->renderModpage($this->data);
    }
  }
}