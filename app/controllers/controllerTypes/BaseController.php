<?php 
require_once __DIR__ . '/ViewController.php';

abstract class BaseController extends ViewController {
  protected $model;

  public function __construct($model, $view, $tittle) {
    $this->model = $model;
    parent::__construct($view, $tittle);
  }

  public abstract function showPage($params = null);
}