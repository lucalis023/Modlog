<?php
require_once '../app/views/View.php';

class loginView extends View {
  public function renderLogin($data) {
    $this->addTemplate('/login/login.phtml');
    $this->renderPage($data);
  }

  public function renderRegister($data) {
    $this->addTemplate('/login/register.phtml');
    $this->renderPage($data);
  }
}