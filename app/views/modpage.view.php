<?php 

class modpageView {
  public function showMod($mod, $game, $creator, $category) {
    require_once dirname(__DIR__, 1) . '/templates/modpage/modpage.phtml';
  }
}