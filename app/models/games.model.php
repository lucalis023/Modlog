<?php 
require_once __DIR__ . '/Model.php';

class gamesModel extends Model {
  
  public function __construct() {
    parent::__construct();
  }

  public function getGames() {
    $query = $this->db->prepare('select * from games');
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
  }

  public function getGameById($game_id) {
    $query = $this->db->prepare('select * from games where id = ?');
    $query->execute([$game_id]);
    return $query->fetch(PDO::FETCH_OBJ);
  }
}