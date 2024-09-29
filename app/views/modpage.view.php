<?php 
require_once __DIR__ . '/View.php';

class modpageView extends View {
  public function renderModpage($data) {
    $this->addTemplate('/modpage/modpage.phtml');
    $this->renderPage($data);
  }
}