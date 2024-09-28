<?php

class View {

  public function renderHeader() {
    require_once dirname(__DIR__, 1) . '/templates/header.phtml';
  }

  public function renderFooter() {
    require_once dirname(__DIR__, 1) . '/templates/footer.phtml';
  }
}