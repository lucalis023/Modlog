<?php 
require_once __DIR__ . '/Model.php';

class catalogModel extends Model {
  
  public function __construct() {
    parent::__construct();
  }

  public function getGame($game_id) {
    $query = $this->db->prepare('select * from games where id = ?');
    $query->execute([$game_id]);
    return $query->fetch(PDO::FETCH_OBJ);
  }

  public function getMods($game_id) {
    $query = $this->db->prepare('select * from mods where game_id = ?');
    $query->execute([$game_id]);
    return $query->fetchAll(PDO::FETCH_OBJ);
  }
}