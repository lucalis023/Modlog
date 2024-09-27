<?php 
require_once __DIR__ . '/Model.php';

class gamesModel extends Model {
  
  public function __construct() {
    parent::__construct();
  }

  public function getGames() {
    $query = $this->db->prepare('select * from games');
    return $this->executeQuery($query);
  }

  public function getGameById($game_id) {
    $query = $this->db->prepare('select * from games where id = ?');
    $result = $this->executeQueryWithParams($query, [$game_id]);
    if (!empty($result)) return $result[0];
  }
}