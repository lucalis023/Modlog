<?php 
require_once __DIR__ . '/View.php';

class catalogView extends View{
  public function renderCatalog($data) {
    extract($data);
    $this->addTemplate(dirname(__DIR__, 1) . '/templates/catalog/catalog_banner.phtml');
    if (!empty($mods)) {
      $this->addTemplate(dirname(__DIR__, 1) . '/templates/catalog/modlist.phtml');
    } else {
      $this->addTemplate(dirname(__DIR__, 1) . '/templates/catalog/empty_modlist.phtml');
    }

    $this->renderPage($data);
  } 
}