<?php
require_once __DIR__ . '/controllerTypes/BaseController.php';

class gamesController extends BaseController {
  
  public function __construct() {
    require_once dirname(__DIR__, 1) . '/models/games.model.php';
    require_once dirname(__DIR__, 1) . '/views/games.view.php';
    parent::__construct(new gamesModel, new gamesView, 'Games');
  }

  public function showPage($params = null) {
    $games = $this->model->getGames();
    $this->setData('games', $games);

    $this->view->renderGames($this->data);
  }
}