<?php

class creatorView {
  public function showCreator($creator, $mods) {
    require_once dirname(__DIR__, 1) . '/templates/creator/creator_header.php';
    if (!empty($mods)) {
      require_once dirname(__DIR__, 1) . '/templates/creator/modlist.php';
    }
  }
}