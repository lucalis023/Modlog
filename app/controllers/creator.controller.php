<?php
require_once '../app/controllers/controllerTypes/ViewController.php';

class creatorController extends ViewController {
  protected $creatorModel;
  protected $modsModel;

  public function __construct(){
    require_once '../app/views/creator.view.php';
    parent::__construct(new creatorView, 'Creator');
    require_once '../app/models/creators.model.php';
    $this->creatorModel = new creatorsModel;
    require_once '../app/models/mods.model.php';
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