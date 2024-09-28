<?php 
require_once __DIR__ . '/View.php';

class errorView extends View {
  public function renderDefaultError() {
    require_once dirname(__DIR__, 1) . '/templates/header.phtml';
    require_once dirname(__DIR__, 1) . '/templates/error/defaultError.phtml';
    require_once dirname(__DIR__, 1) . '/templates/footer.phtml';
  }

  public function renderMissingParams() {
    require_once dirname(__DIR__, 1) . '/templates/header.phtml';
    require_once dirname(__DIR__, 1) . '/templates/error/missingParams.phtml';
    require_once dirname(__DIR__, 1) . '/templates/footer.phtml';
  }

  public function renderEmptyResponse() {
    require_once dirname(__DIR__, 1) . '/templates/header.phtml';
    require_once dirname(__DIR__, 1) . '/templates/error/emptyResponse.phtml';
    require_once dirname(__DIR__, 1) . '/templates/footer.phtml';
  }
}