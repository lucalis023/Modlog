<?php

require_once './app/controllers/controllerTypes/BaseController.php';

class loginController extends BaseController {

  public function __construct() {
    require_once './app/models/users.model.php';
    require_once './app/views/login.view.php';
    parent::__construct(new usersModel, new loginView, 'Login');
  }

  public function handleLogin() {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $email = $_POST['email'] ?? null;
      $pass = $_POST['pass'] ?? null;

      $user = $this->model->getUserByEmail($email);

      if (!empty($user)) {
        if (password_verify($pass, $user->password)) {
          $this->setUser($user);
          header('Location: '. BASE_URL);

        } else {
          $this->setData('wrongPass', true);
          $this->view->renderLogin($this->data);
        }
      } else {
        $this->setData('wrongEmail', true);
        $this->view->renderLogin($this->data);
      }
    } else {
       $this->view->renderLogin($this->data);
    }
  }


  public function handleLogout() {
    if($_SERVER['REQUEST_METHOD'] == 'POST') { 
      $url = $_POST['url'] ?? BASE_URL;
      unset($_SESSION['user_id']);
      unset($_SESSION['user_name']);
      unset($_SESSION['admin']);
      session_destroy();
      header('Location: ' . $url);
    }
  }


  public function handleRegister() {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $user = $_POST['user'] ?? null;
      $email = $_POST['email'] ?? null;
      $pass = $_POST['pass'] ?? null;

      if (!empty($user) && !empty($email) && !empty($pass)) {
        $this->model->createUser($user, $email, $pass);
        header('Location: ' . BASE_URL . 'login/');
      }
    } else {
      $this->view->renderRegister($this->data);
    }
  }
}