<?php 
require_once __DIR__ . '/View.php';

class modpageView extends View {
  public function renderModpage($data) {
    $this->addTemplate(dirname(__DIR__, 1) . '/templates/modpage/modpage.phtml');
    $this->renderPage($data);
  }
}