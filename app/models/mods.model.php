<?php
require_once __DIR__ . '/Model.php';

class modsModel extends Model {
  
  public function __construct() {
    parent::__construct();
  }

  public function getModsByGame($game_id) {
    $query = $this->db->prepare('select * from mods where game_id = ?');
    $query->execute([$game_id]);
    return $query->fetchAll(PDO::FETCH_OBJ);
  }
}