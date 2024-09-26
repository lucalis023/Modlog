<?php 
require_once __DIR__ . '/Controller.php';

class catalogController extends Controller {
  
  public function __construct() {
    require_once '../models/catalog.model.php';
    require_once '../views/catalog.view.php';
    parent::__construct(new catalogModel, new catalogView);
  }
}