<?php 

class ViewController {
  protected $view;
  protected $error;

  public function __construct($view) {
    $this->view = $view;
    require_once dirname(__DIR__, 1) . '/error.controller.php';
    $this->error = new errorController;
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
}