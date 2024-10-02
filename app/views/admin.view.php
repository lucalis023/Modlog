<?php 
require_once '../app/views/View.php';

class adminView extends View{
  public function renderAddGame($data) {
    $this->addTemplate('/admin/adminCheck.php');
    $this->addTemplate('/admin/addGame.phtml');
    $this->renderPage($data);
  }

  public function renderEditGame($data) {
    extract($data);
    $this->addTemplate('/admin/adminCheck.php');
    $this->addTemplate('/admin/editGame.phtml');
    $this->renderPage($data);
  }
}