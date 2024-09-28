<?php 
require_once __DIR__ . '/View.php';

class modpageView extends View {
  public function renderModpage($data) {
    extract($data);
    require_once dirname(__DIR__, 1) . '/templates/header.phtml';
    require_once dirname(__DIR__, 1) . '/templates/modpage/modpage.phtml';
    require_once dirname(__DIR__, 1) . '/templates/footer.phtml';
  }
}