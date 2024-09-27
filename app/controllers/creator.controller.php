<?php
require_once __DIR__ . '/controllerTypes/ViewController.php';

class creatorController extends ViewController {
  protected $creatorModel;
  protected $modsModel;

  public function __construct(){
    require_once dirname(__DIR__, 1) . '/views/creator.view.php';
    parent::__construct(new creatorView);
    require_once dirname(__DIR__, 1) . '/models/creators.model.php';
    $this->creatorModel = new creatorsModel;
    require_once dirname(__DIR__, 1) . '/models/mods.model.php';
    $this->modsModel = new modsModel;
  }

  public function showCreator($id) {
    $creator = $this->creatorModel->getCreatorById($id);
    if ($this->isNotEmpty($creator)) {
      $mods = $this->modsModel->getModsByCreator($id);
      $this->view->showCreator($creator, $mods);
    }
  }
}