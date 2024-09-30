<?php 

abstract class ViewController {
  protected $view;
  protected $error;
  protected $data;

  public function __construct($view, $tittle) {
    $this->view = $view;
    require_once dirname(__DIR__, 1) . '/error.controller.php';
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


  public function setTittle($value) {
    $this->setData('tittle', 'Modlog: ' . $value);
  }

  public function setUser($id, $username) {
    $_SESSION['user_id'] = $id;
    $_SESSION['user_name'] = $username;
  }

  public abstract function showPage($params = null);
}