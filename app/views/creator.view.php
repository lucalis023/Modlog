<?php
require_once __DIR__ . '/View.php';

class creatorView extends View {
  public function renderCreator($data) {
    extract($data);
    require_once dirname(__DIR__, 1) . '/templates/header.phtml';
    require_once dirname(__DIR__, 1) . '/templates/creator/creator_header.php';
    if (!empty($mods)) {
      require_once dirname(__DIR__, 1) . '/templates/creator/modlist.php';
    }
    require_once dirname(__DIR__, 1) . '/templates/footer.phtml';
  }
}