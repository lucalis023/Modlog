<?php
require_once '../app/controllers/controllerTypes/BaseController.php';

class gamesController extends BaseController {
  
  public function __construct() {
    require_once '../app/models/games.model.php';
    require_once '../app/views/games.view.php';
    parent::__construct(new gamesModel, new gamesView, 'Games');
  }

  public function showPage($params = null) {
    $games = $this->model->getGames();
    $this->setData('games', $games);

    $this->view->renderGames($this->data);
  }
}