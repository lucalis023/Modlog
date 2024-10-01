<?php

require_once '../app/controllers/controllerTypes/BaseController.php';

class loginController extends BaseController {

  public function __construct() {
    require_once '../app/models/users.model.php';
    require_once '../app/views/login.view.php';
    parent::__construct(new usersModel, new loginView, 'Login');
  }

  public function showPage($params = null) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      $this->handleLogin();

    } else {
      $this->view->renderLogin([]);
    }
  }

  public function handleLogin() {
    $action = $_POST['action'] ?? null;
    switch ($action) {
      case 'log-in': 
        $this->logIn();
        break;
      case 'log-out':
        $this->logOut($_POST['url']);
    }
  }

  public function logIn() {
    $user = $_POST['user'] ?? null;
    $pass = $_POST['pass'] ?? null;

    if ($this->model->isNameinDB($user)) {
      $user = $this->model->getUser($user, $pass);

      if (!empty($user)) {
        $this->setUser($user->id, $user->username);
        header('Location: '. BASE_URL);

      } else {
        $this->setData('wrongPass', true);
        $this->view->renderLogin($this->data);
      }

    } else {
      $this->setData('wrongUser', true);
      $this->view->renderLogin($this->data);
    }
  }

  public function logOut($url) {
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    header('Location: ' . $url);
  }
}