<?php 
require_once __DIR__ . '/View.php';

class gamesView extends View {

  public function renderGames($data) {
    extract($data);
    $this->addTemplate(dirname(__DIR__, 1) . '/templates/games/games_list.phtml');
    $this->renderPage($data);
  }
}