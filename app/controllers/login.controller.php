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
      switch ($params[0]) {
        case 'login':
          $this->view->renderLogin([]);
          break;
        case 'register':
          $this->view->renderRegister([]);
          break;
        default: 
          $this->view->renderLogin([]);
      }
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
        break;
      case 'register': 
        $this->register();
        break;
    }
  }


  public function logIn() {
    $email = $_POST['email'] ?? null;
    $pass = $_POST['pass'] ?? null;

    $user = $this->model->getUserByEmail($email);

    if (!empty($user)) {
      if (password_verify($pass, $user->password)) {
        $this->setUser($user->id, $user->username);
        header('Location: '. BASE_URL);

      } else {
        $this->setData('wrongPass', true);
        $this->view->renderLogin($this->data);
      }
    } else {
      $this->setData('wrongEmail', true);
      $this->view->renderLogin($this->data);
    }
  }


  public function logOut($url) {
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    header('Location: ' . $url);
  }


  public function register() {
    $user = $_POST['user'] ?? null;
    $email = $_POST['email'] ?? null;
    $pass = $_POST['pass'] ?? null;

    if (!empty($user) && !empty($email) && !empty($pass)) {
      $this->model->createUser($user, $email, $pass);
      header('Location: ' . BASE_URL . 'login/');
    }
  }
}