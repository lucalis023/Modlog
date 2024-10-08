<?php 
require_once './app/views/View.php';

class errorView extends View {
  public function renderDefaultError($err) {
    $this->addTemplate('/error/defaultError.phtml');
    echo $err->getMessage();
    $this->renderPage([]);
  }

  public function renderMissingParams() {
    $this->addTemplate('error/missingParams.phtml');
    $this->renderPage([]);
  }

  public function renderEmptyResponse() {
    $this->addTemplate('/error/emptyResponse.phtml');
    $this->renderPage([]);
  }
}