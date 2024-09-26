<?php 

class catalogView {
  public function showCatalog($game, $mods) {
    require_once dirname(__DIR__, 1) . '/templates/catalog/catalog_header.phtml';
    if (!empty($mods)) {
      require_once dirname(__DIR__, 1) . '/templates/catalog/modlist.phtml';
    } else {
      require_once dirname(__DIR__, 1) . '/templates/catalog/empty_modlist.phtml';
    }
  } 
}