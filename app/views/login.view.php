<?php
require_once '../app/views/View.php';

class loginView extends View {
  public function renderLogin($data) {
    $this->addTemplate('/login/login.phtml');
    $this->renderPage($data);
  }
}