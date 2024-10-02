<?php 
require_once '../app/controllers/controllerTypes/ViewController.php';

class adminController extends ViewController {
  public function __construct() {
    require_once '../app/views/admin.view.php';
    parent::__construct(new adminView, 'Admin');
  }

  public function showPage($params = null) {
    if (!(isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
      header('Location: ' . BASE_URL);
    }

    if ($this->isNotEmpty($params[1])) {
      switch ($params[1]) {
        case 'games':
          $this->handleGames($params);
          break;
      }
    }
  }

  public function handleGames($params) {
    if ($this->isNotEmpty($params[2])) {
      require_once '../app/models/games.model.php';
      $model = new gamesModel;

      if ($params[2] == 'new') {
        $this->addGame($model);
      } else {
        $this->editGame($model, $params);
      }
    }
  }

  public function addGame($model) {
    // Executes on add submit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $name = $_POST['name'] ?? null;
      $description = $_POST['description'] ?? null;
      $model->createGame($name, $description);
      header('Location: ' . BASE_URL);
    } else {
      // Executes to load add page otherwise
      $this->view->renderAddGame([]);
    }
  }

  public function editGame($model, $params) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Executes if controller is loaded from edit page
      if (isset($params[3]) && $params[3] == 'delete') {
        // Deletes game
        $model->deleteGame($params[2]);
        header('Location: ' . BASE_URL);

      } else {
        // Edits game
        $name = $_POST['name'] ?? null;
        $description = $_POST['description'] ?? null;
        $model->updateGame($name, $description, $params[2]);
        header('Location: ' . BASE_URL);
      }
    } else {
      // Loads edit page normally otherwise
      $game = $model->getGameById($params[2]);
      if (!empty($game)) {
        $this->setData('game', $game);
        $this->view->renderEditGame($this->data);
      }
    }
  }
}