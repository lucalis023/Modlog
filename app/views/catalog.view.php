<?php 
require_once __DIR__ . '/View.php';

class catalogView extends View{
  public function renderCatalog($data) {
    extract($data);
    require_once dirname(__DIR__, 1) . '/templates/header.phtml';
    require_once dirname(__DIR__, 1) . '/templates/catalog/catalog_banner.phtml';
    if (!empty($mods)) {
      require_once dirname(__DIR__, 1) . '/templates/catalog/modlist.phtml';
    } else {
      require_once dirname(__DIR__, 1) . '/templates/catalog/empty_modlist.phtml';
    }
    require_once dirname(__DIR__, 1) . '/templates/footer.phtml';
  } 
}