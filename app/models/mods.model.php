<?php
require_once __DIR__ . '/Model.php';

class modsModel extends Model {
  
  public function __construct() {
    parent::__construct();
  }

  public function getModsByGame($game_id) {
    $query = $this->db->prepare('select * from mods where game_id = ?');
    return $this->executeQueryWithParams($query, [$game_id]);
  }

  public function getModById($id) {
    $query = $this->db->prepare('select * from mods where id = ?');
    $result = $this->executeQueryWithParams($query, [$id]);
    if(!empty($result)) return $result[0];
  }
}