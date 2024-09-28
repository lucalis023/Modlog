<?php 
require_once __DIR__ . '/View.php';

class gamesView extends View {

  public function renderGames($data) {
    extract($data);
    require_once dirname(__DIR__, 1) . '/templates/header.phtml';
    require_once dirname(__DIR__, 1) . '/templates/games/games_list.phtml';
    require_once dirname(__DIR__, 1) . '/templates/footer.phtml';
  }
}