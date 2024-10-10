<?php 
require_once './app/views/View.php';

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

  public function renderAdminCategory($data) {
    extract($data);
    $this->addTemplate('/admin/adminCategory.phtml');
    $this->renderPage($data);
  }

  public function renderAdminMod($data) {
    extract($data);
    $this->addTemplate('/admin/adminMod.phtml');
    $this->renderPage($data);
  }
}