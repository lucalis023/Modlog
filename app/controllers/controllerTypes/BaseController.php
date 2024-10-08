<?php 
require_once './app/controllers/controllerTypes/ViewController.php';

abstract class BaseController extends ViewController {
  protected $model;

  public function __construct($model, $view, $tittle) {
    $this->model = $model;
    parent::__construct($view, $tittle);
  }
}