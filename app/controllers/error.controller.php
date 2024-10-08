<?php

require_once './app/controllers/controllerTypes/ViewController.php';

class errorController {
  protected $view;

  public function __construct() {
    require_once './app/views/error.view.php';
    $this->view = new errorView;
  }

  public function handleError($err) {
    switch ($err->getMessage()) {
      case 'Missing parameters.':
        $this->view->renderMissingParams();
        break;
      case 'Empty response.':
        $this->view->renderEmptyResponse();
        break;
      default:
        $this->view->renderDefaultError($err); 
      }
  }
}