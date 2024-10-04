<?php 
require_once '../app/views/View.php';

class adminView extends View{
  public function renderGame($data) {
    extract($data);
    $this->addTemplate('/admin/adminCheck.php');
    $this->addTemplate('/admin/adminGame.phtml');
    $this->renderPage($data);
  }


  public function renderCategory($data) {
    extract($data);
    $this->addTemplate('/admin/adminCheck.php');
    $this->addTemplate('/admin/adminCategory.phtml');
    $this->renderPage($data);
  }

  public function renderCreator($data) {
    extract($data);
    $this->addTemplate('/admin/adminCheck.php');
    $this->addTemplate('/admin/adminCreator.phtml');
    $this->renderPage($data);
  }

}