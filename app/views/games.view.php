<?php 

class gamesView {

  public function showGames($games) {
    require_once dirname(__DIR__, 1) . '/templates/games_list.phtml';
  }
}