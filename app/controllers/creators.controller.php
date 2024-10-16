<?php
require_once './app/controllers/controllerTypes/ViewController.php';

class creatorsController extends ViewController {

  protected $creatorModel;
  protected $modsModel;
  
  public function __construct(){
    require_once './app/views/creators.view.php';
    parent::__construct(new creatorsView, 'Creators');
    require_once './app/models/creators.model.php';
    $this->creatorModel = new creatorsModel;
    require_once './app/models/mods.model.php';
    $this->modsModel = new modsModel;
  }

  public function showCreator($params) {
    $creator = $this->creatorModel->getCreatorById($params['id']);
    if ($this->isNotEmpty($creator)) {
      $this->setTittle($creator->name);
      $this->setData('creator', $creator);

      $mods = $this->modsModel->getModsByCreator($creator->id);
      $this->setData('mods', $mods);

      $this->view->renderCreator($this->data);
    }

  } 

  public function showCreators($params) {
    $creators = $this->creatorModel->getCreators();
    $this->setData('creators', $creators);
    $this->view->renderCreators($this->data);
  }

  public function showEdit($params) {
    $this->setData('creator', $this->creatorModel->getCreatorById($params['id']));
    $this->setData('mode', 'edit');
    $this->view->renderAdmin($this->data);
  }

  public function showNew($params) {
    $this->setData('mode', 'new');
    $this->view->renderAdmin($this->data);
  }

  public function create($params) {
    require_once './app/middlewares/formHandling.php';
    $this->setDataFromArray(getForm());
    $this->creatorModel->create($this->data);
    header('Location: ' . BASE_URL . 'creators');
  }

  public function update($params) {
    require_once './app/middlewares/formHandling.php';
    $this->setDataFromArray(getForm());
    $this->creatorModel->update($this->data);
    header('Location: ' . BASE_URL . 'creators');
  }

  public function delete($params) {
    $this->creatorModel->delete($params['id']);
    header('Location: ' . BASE_URL . 'creators');
  }
}