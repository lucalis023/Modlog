<?php
require_once __DIR__ . '/controllerTypes/ViewController.php';

class creatorController extends ViewController {
  protected $creatorModel;
  protected $modsModel;

  public function __construct(){
    require_once dirname(__DIR__, 1) . '/views/creator.view.php';
    parent::__construct(new creatorView, 'Creator');
    require_once dirname(__DIR__, 1) . '/models/creators.model.php';
    $this->creatorModel = new creatorsModel;
    require_once dirname(__DIR__, 1) . '/models/mods.model.php';
    $this->modsModel = new modsModel;
  }

  public function showPage($params = null) {
    $creator = $this->creatorModel->getCreatorById($params[1]);
    if ($this->isNotEmpty($creator)) {
      $this->setTittle($creator->name);
      $this->setData('creator', $creator);

      $mods = $this->modsModel->getModsByCreator($creator->id);
      $this->setData('mods', $mods);

      $this->view->renderCreator($this->data);
    }
  }
}