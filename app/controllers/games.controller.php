<?php
require_once './app/controllers/controllerTypes/BaseController.php';

class gamesController extends BaseController {
  
  public function __construct() {
    require_once './app/models/games.model.php';
    require_once './app/views/games.view.php';
    parent::__construct(new gamesModel, new gamesView, 'Games');
  }

  public function showPage($params = null) {
    $games = $this->model->getGames();
    $this->setData('games', $games);
    $this->view->renderGames($this->data);
  }

  public function showEdit($params) {
    $this->setData('game', $this->model->getGameById($params['id']));
    $this->setData('mode', 'edit');
    $this->view->renderAdmin($this->data);
  }

  public function showNew($params) {
    $this->setData('mode', 'new');
    $this->view->renderAdmin($this->data);
  }

  public function create($params) {
    require_once './app/middlewares/formHandling.php';
    $this->setDataFromArray(getForm('games'));
    $this->model->create($this->data);
    header('Location: ' . BASE_URL);
  }

  public function update($params) {
    require_once './app/middlewares/formHandling.php';
    $this->setDataFromArray(getForm('games'));
    $this->model->update($this->data);
    header('Location: ' . BASE_URL);
  }

  public function delete($params) {
    $this->model->delete($params['id']);
    header('Location: ' . BASE_URL);
  }
}