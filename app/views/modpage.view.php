<?php 
require_once './app/views/View.php';

class modpageView extends View {
  public function renderModpage($data) {
    $this->addStylesheet('detailPage.css');
    $this->addTemplate('/modpage/modpage.phtml');
    $this->renderPage($data);
  }
}