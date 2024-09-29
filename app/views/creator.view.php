<?php
require_once __DIR__ . '/View.php';

class creatorView extends View {
  public function renderCreator($data) {
    extract($data);
    $this->addTemplate('/creator/creator_header.php');
    if (!empty($mods)) {
      $this->addTemplate('/creator/modlist.php');
    }

    $this->renderPage($data);
  }
}