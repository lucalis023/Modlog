<?php 

abstract class ViewController {
  protected $view;
  protected $error;
  protected $data;

  public function __construct($view, $tittle) {
    $this->view = $view;
    require_once './app/controllers/error.controller.php';
    $this->error = new errorController;
    $this->setTittle($tittle);
  }

  public function isNotEmpty($var) {
    try {
      if(!empty($var)) {
        return true;
      } 
      throw new Exception('Empty response.');
    } catch (Exception $err) {
      $this->error->handleError($err);
    }
  }


  public function setData($key, $value) {
    $this->data[$key] = $value;
  }

  public function setDataFromArray($array) {
    foreach ($array as $key => $value) {
      $this->setData($key, $value);
    }
  }


  public function setTittle($value) {
    $this->setData('tittle', 'Modlog: ' . $value);
  }

  public function setUser($user) {
    extract((array) $user);
    $_SESSION['user_id'] = $id;
    $_SESSION['user_name'] = $username;
    $_SESSION['admin'] = $admin;
  }
}