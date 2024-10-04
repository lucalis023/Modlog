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

  public function handleGames($params) {
    // Runs if request comes from form
    require_once '../app/models/games.model.php';
    $model = new gamesModel;
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



  public function handleCategories($params) {
    // Runs if request comes from form
    require_once '../app/models/categories.model.php';
    $categoriesModel = new categoriesModel;

    require_once '../app/models/games.model.php';
    $gamesModel = new gamesModel;
    $game = $gamesModel->getGameById($params[2] ?? null);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      switch ($params[3]) {
        case 'new':
          $this->addcategory($categoriesModel, $game->id);
          break;
        case 'delete':
          $this->deleteCategory($categoriesModel, $params);
          break;
        default:
          $this->editCategory($categoriesModel, $params);
          break;
      }
      header('Location: ' . BASE_URL . 'catalog/' . $game->id);
      
    } else {
      // Executes if page opened through <a>
      switch ($params[3]) {
        case 'new':
          $this->setData('mode', 'add');
          $this->setData('game', $game);
          $this->view->renderCategory($this->data);
          break;
        default:
          $this->setData('mode', 'edit');
          $category = $categoriesModel->getCategoryById($params[3]);
          if (!empty($category)) {
            $this->setData('category', $category);
            $this->setData('game', $game);
            $this->view->renderCategory($this->data);
          } else {
            header('Location: ' . BASE_URL . 'catalog/' . $game->id);
          }
          break;
      }
    }
  }
  
  public function addCategory($model, $game_id) {
    $name = $_POST['name'] ?? null;
    $model->createCategory($name, $game_id);
  }
  
  public function editCategory($model, $params) {
    $name = $_POST['name'] ?? null;
    $model->updateCategory($name, $params[3]);
  }
  
  public function deleteCategory($model, $params) {
    if ($this->isNotEmpty($params[4]))
      $model->deleteCategory($params[4]);
  }


  public function handleCreators($params) {
    // Runs if request comes from form
    require_once '../app/models/creators.model.php';
    $model = new creatorsModel;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      switch ($params[2]) {
        case 'new':
          $this->addCreator($model);
          break;
        case 'delete':
          $this->deleteCreator($model, $params);
          break;
        default:
          $this->editCreator($model, $params);
          break;
      }
      // header('Location: ' . BASE_URL . 'creators');

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

  public function addCreator($model) {
    $name = $_POST['name'] ?? null;
    $link = $_POST['link'] ?? null;
    $model->createCreator($name, $link);
  }

  public function editCreator($model, $params) {
    $name = $_POST['name'] ?? null;
    $link = $_POST['link'] ?? null;
    $model->updateCreator($params[2], $name, $link);
  }

  public function deleteCreator($model, $params) {
    if ($this->isNotEmpty($params[3]))
      $model->deleteCreator($params[3]);
  }
}