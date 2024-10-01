<?php

class View {
  protected $templates = [];

  public function renderHeader() {
    require_once '../app/templates/header.phtml';
  }

  public function renderFooter() {
    require_once '../app/templates/footer.phtml';
  }

  public function renderPage($data) {
    extract($data);
    $this->renderHeader();
    foreach ($this->templates as $template) {
      require_once $template;
    }
    $this->renderFooter();
  }

  public function addTemplate($template) {  
    $template = '../app/templates' . $template;
    array_push($this->templates, $template);
  }
}