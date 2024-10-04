<?php
require_once '../app/controllers/controllerTypes/ViewController.php';

class creatorsController extends ViewController {


  public function __construct(){
    require_once '../app/views/creators.view.php';
    parent::__construct(new creatorsView, 'Creator');
  }

  public function showPage($params = null) {
    require_once '../app/models/creators.model.php';
    $creatorModel = new creatorsModel;
    if (isset($params[1]) && !empty($params[1])) {
      require_once '../app/models/mods.model.php';
      $modsModel = new modsModel;
      $creator = $creatorModel->getCreatorById($params[1]);
      if ($this->isNotEmpty($creator)) {
        $this->setTittle($creator->name);
        $this->setData('creator', $creator);

        $mods = $modsModel->getModsByCreator($creator->id);
        $this->setData('mods', $mods);

        $this->view->renderCreator($this->data);
      }
    } else {
      $creators = $creatorModel->getCreators();
      $this->setData('creators', $creators);
      $this->view->renderCreators($this->data);
    }
  } 
}