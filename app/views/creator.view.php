<?php
require_once '../app/views/View.php';

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