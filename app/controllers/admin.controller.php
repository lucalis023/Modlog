<?php 
require_once './app/controllers/controllerTypes/ViewController.php';

class adminController extends ViewController {
  public function __construct() {
    require_once './app/views/admin.view.php';
    parent::__construct(new adminView, 'Admin');

    if (!(isset($_SESSION['admin']) && $_SESSION['admin'] == 1)) {
      header('Location: ' . BASE_URL);
    }
  }


  public function handleCRUD($model, $action, $table = '') {
    foreach ($_POST as $key => $value) {
      $this->setData($key, $value);
    } 

    if (isset($_FILES['image'])) {
      $image = $_FILES['image'];

      // Builds unique filename
      $fileName = $_POST['name'] . '_' . md5(date('Y-m-d H:i:s')) . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
      $uploadName = './public/uploads/'. $table . '/' . $fileName;
      $absoluteRoute = BASE_URL . 'public/uploads/' . $table . '/' . $fileName;

      if (move_uploaded_file($image['tmp_name'], $uploadName)) {
        $this->setData('image', $absoluteRoute);
      }
    }

    switch ($action) {
      case 'new':
        $model->create($this->data);
        break;
      default:
        $model->update($this->data);
    }
  }

  public function handleGame($params) {
    // Runs if request comes from form
    require_once './app/models/games.model.php';
    $model = new gamesModel;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $this->handleCRUD($model, $params['id'], 'games');
      header('Location: ' . BASE_URL);
    } else {
      // Executes if page opened through <a>
      switch ($params['id']) {
        case 'new':
          $this->setData('mode', 'add');
          $this->view->renderGame($this->data);
          break;
        default:
          $this->setData('mode', 'edit');
          $game = $model->getGameById($params['id']);
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

  public function deleteGame($params) {
    require_once './app/models/games.model.php';
    (new gamesModel)->delete($params['id']);
    header('Location: ' . BASE_URL);
  }


  public function handleCategory($params) {
    require_once './app/models/categories.model.php';
    $categoriesModel = new categoriesModel;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Runs if request comes from form
      $this->handleCRUD($categoriesModel, $params['id']);
      header('Location: ' . BASE_URL . 'catalog/' . $params['game']);
      
    } else {
      // Executes if page opened through <a>

      require_once './app/models/games.model.php';
      $this->setData('game', (new gamesModel)->getGameById($params['game']));

      switch ($params['id']) {
        case 'new':
          $this->setData('mode', 'add');
          $this->view->renderCategory($this->data);
          break;
        default:
          $this->setData('mode', 'edit');
          $category = $categoriesModel->getCategoryById($params['id']);
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

  public function deleteCategory($params) {
    require_once './app/models/categories.model.php';
    (new categoriesModel)->delete($params['id']);
    header('Location: ' . BASE_URL);
  }


  public function handleCreator($params) {
    // Runs if request comes from form
    require_once './app/models/creators.model.php';
    $model = new creatorsModel;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $this->handleCRUD($model, $params['id']);
      header('Location: ' . BASE_URL . 'creators');

    } else {
      // Executes if page opened through <a>
      switch ($params['id']) {
        case 'new':
          $this->setData('mode', 'add');
          $this->view->renderCreator($this->data);
          break;
        default:
          $this->setData('mode', 'edit');
          $creator = $model->getCreatorById($params['id']);
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

  public function deleteCreator($params) {
    require_once './app/models/creators.model.php';
    (new creatorsModel)->delete($params['id']);
    header('Location: ' . BASE_URL .'creators');
  }

  public function handleMod($params) {
    require_once './app/models/mods.model.php';
    $modsModel = new modsModel;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Runs if request comes from form
      $this->handleCRUD($modsModel, $params['id'], 'mods');
      header('Location: ' . BASE_URL . 'catalog/' . $params['game']);
      
    } else {
      // Executes if page opened through <a>
      require_once './app/models/games.model.php';
      $this->setData('game', (new gamesModel)->getGameById($params['game']));

      require_once './app/models/categories.model.php';
      $this->setData('categories', (new categoriesModel)->getCategoriesByGame($params['game']));

      require_once './app/models/creators.model.php';
      $this->setData('creators', (new creatorsModel)->getCreators());

      switch ($params['id']) {
        case 'new':
          $this->setData('mode', 'add');
          $this->view->renderMod($this->data);
          break;
        default:
          $this->setData('mode', 'edit');
          $mod = $modsModel->getModById($params['id']);
          if ($this->isNotEmpty($mod)) {
            $this->setData('mod', $mod);
            $this->view->renderMod($this->data);
          } else {
            header('Location: ' . BASE_URL . 'catalog/' . $params['game']);
          }
          break;
      }
    }
  }

  public function deleteMod($params) {
    require_once './app/models/mods.model.php';
    (new modsModel)->delete($params['id']);
    header('Location: ' . BASE_URL);
  }
}