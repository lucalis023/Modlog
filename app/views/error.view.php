<?php 
require_once __DIR__ . '/View.php';

class errorView extends View {
  public function renderDefaultError() {
    $this->addTemplate(dirname(__DIR__, 1) . '/templates/error/defaultError.phtml');
    $this->renderPage([]);
  }

  public function renderMissingParams() {
    $this->addTemplate(dirname(__DIR__, 1) . '/templates/error/missingParams.phtml');
    $this->renderPage([]);
  }

  public function renderEmptyResponse() {
    $this->addTemplate(__DIR__, 1) . '/templates/error/emptyResponse.phtml';
    $this->renderPage([]);
  }
}