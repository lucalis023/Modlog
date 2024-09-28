<?php
require_once __DIR__ . '/View.php';

class creatorView extends View {
  public function renderCreator($data) {
    extract($data);
    $this->addTemplate(dirname(__DIR__, 1) . '/templates/creator/creator_header.php');
    if (!empty($mods)) {
      $this->addTemplate(dirname(__DIR__, 1) . '/templates/creator/modlist.php');
    }

    $this->renderPage($data);
  }
}