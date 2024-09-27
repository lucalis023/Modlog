<?php 

class errorView {
  public function showDefaultError() {
    require_once dirname(__DIR__, 1) . '/templates/error/defaultError.phtml';
  }

  public function showMissingParams() {
    require_once dirname(__DIR__, 1) . '/templates/error/missingParams.phtml';
  }

  public function showEmptyResponse() {
    require_once dirname(__DIR__, 1) . '/templates/error/emptyResponse.phtml';
  }
}