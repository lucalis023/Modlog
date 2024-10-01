<?php 
require_once '../app/views/View.php';

class catalogView extends View{
  public function renderCatalog($data) {
    extract($data);
    $this->addTemplate('/catalog/catalog_banner.phtml');
    $this->addTemplate('/catalog/categories_sidebar.phtml');
    if (!empty($mods)) {
      $this->addTemplate('/catalog/modlist.phtml');
    } else {
      $this->addTemplate('/catalog/empty_modlist.phtml');
    }

    $this->renderPage($data);
  } 
}