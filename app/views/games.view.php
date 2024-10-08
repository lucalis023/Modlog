<?php 
require_once './app/views/View.php';

class gamesView extends View {

  public function renderGames($data) {
    extract($data);
    $this->addTemplate('/games/games_list.phtml');
    $this->renderPage($data);
  }
}