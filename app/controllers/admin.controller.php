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
        case 'categories':
          $this->handleCategories($params);
          break;
        case 'creators':
          $this->handleCreators($params);
          break;
        default:
          header('Location: ' . BASE_URL);
      }
    }
  }

  public function handleCRUD($model, $action) {
    foreach ($_POST as $key => $value) {
      $this->setData($key, $value);
    } 
    switch ($action) {
      case 'new':
        $model->create($this->data);
        break;
      case 'delete': 
        $model->delete($this->data['id']);
        break;
      default:
        $model->update($this->data);
    }
  }

  public function handleGames($params) {
    // Runs if request comes from form
    require_once '../app/models/games.model.php';
    $model = new gamesModel;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $this->handleCRUD($model, $params[2]);
      header('Location: ' . BASE_URL);

    } else {
      // Executes if page opened through <a>
      switch ($params[2]) {
        case 'new':
          $this->setData('mode', 'add');
          $this->view->renderGame($this->data);
          break;
        default:
          $this->setData('mode', 'edit');
          $game = $model->getGameById($params[2]);
          if (!empty($game)) {
            $this->setData('game', $game);
            $this->view->renderGame($this->data);
          } else {
            header('Location: ' . BASE_URL);
          }
          break;
      }
    }
  }


  public function handleCategories($params) {
    require_once '../app/models/categories.model.php';
    $categoriesModel = new categoriesModel;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Runs if request comes from form
      $this->handleCRUD($categoriesModel, $params[2]);
      header('Location: ' . BASE_URL);
      
    } else {
      // Executes if page opened through <a>

      require_once '../app/models/games.model.php';
      $gamesModel = new gamesModel;
      $games = $gamesModel->getGames();
      $this->setData('games', $games);

      switch ($params[2]) {
        case 'new':
          $this->setData('mode', 'add');
          $this->view->renderCategory($this->data);
          break;
        default:
          $this->setData('mode', 'edit');
          $category = $categoriesModel->getCategoryById($params[2]);
          if ($this->isNotEmpty($category)) {
            $this->setData('category', $category);
            $this->view->renderCategory($this->data);
          } else {
            header('Location: ' . BASE_URL);
          }
          break;
      }
    }
  }


  public function handleCreators($params) {
    // Runs if request comes from form
    require_once '../app/models/creators.model.php';
    $model = new creatorsModel;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $this->handleCRUD($model, $params[2]);
      header('Location: ' . BASE_URL . 'creators');

    } else {
      // Executes if page opened through <a>
      switch ($params[2]) {
        case 'new':
          $this->setData('mode', 'add');
          $this->view->renderCreator($this->data);
          break;
        default:
          $this->setData('mode', 'edit');
          $creator = $model->getCreatorById($params[2]);
          if (!empty($creator)) {
            $this->setData('creator', $creator);
            $this->view->renderCreator($this->data);
          } else {
            header('Location: ' . BASE_URL . 'creators');
          }
          break;
      }
    }
  }
}