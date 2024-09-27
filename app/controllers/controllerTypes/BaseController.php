<?php 
require_once __DIR__ . '/ViewController.php';

class BaseController extends ViewController {
  protected $model;

  public function __construct($model, $view) {
    $this->model = $model;
    parent::__construct($view);
  }
}