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

    if ($this->isNotEmpty($params[1]) && $this->isNotEmpty($params[2])) {
      switch ($params[1]) {
        case 'games':
          $this->handleGames($params);
          break;
      }
    }
  }

  public function handleGames($params) {
    require_once '../app/models/games.model.php';
    $model = new gamesModel;

    // Runs if request comes from form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      switch ($params[2]) {
        case 'new':
          $this->addGame($model);
          break;
        case 'delete':
          $this->deleteGame($model, $params);
          break;
        default:
          $this->editGame($model, $params);
          break;
      }
      header('Location: ' . BASE_URL);

    } else {
      // Executes if page opened through <a>
      switch ($params[2]) {
        case 'new':
          $this->view->renderAddGame([]);
          break;
        default:
          $game = $model->getGameById($params[2]);
          if (!empty($game)) {
            $this->setData('game', $game);
            $this->view->renderEditGame($this->data);
          } else {
            header('Location: ' . BASE_URL);
          }
          break;
      }
    }
  }

  public function addGame($model) {
    $name = $_POST['name'] ?? null;
    $description = $_POST['description'] ?? null;
    $model->createGame($name, $description);
  }

  public function editGame($model, $params) {
    $name = $_POST['name'] ?? null;
    $description = $_POST['description'] ?? null;
    $model->updateGame($name, $description, $params[2]);
  }

  public function deleteGame($model, $params) {
    if ($this->isNotEmpty($params[3]))
      $model->deleteGame($params[3]);
  }
}