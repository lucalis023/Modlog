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
    parent::__construct(new modpageView);
  }

  public function showMod($mod_id) {
    $mod = $this->modsModel->getModById($mod_id);
    if (!empty($mod)){
      $creator = $this->creatorsModel->getCreatorById($mod->id);
      $game = $this->gamesModel->getGameById($mod->game_id);
      $category = $this->categoriesModel->getCategoryById($mod->category_id);
      
      $this->view->showMod($mod, $game, $creator, $category);
    } else {
      echo 'No mod found.';
    }
  }
}