<?php
require_once '../app/models/Model.php';

class modsModel extends Model {
  
  public function __construct() {
    parent::__construct();
  }

  public function getModsByGame($game_id) {
    $query = $this->db->prepare('select * from mods where game_id = ?');
    $result = $this->executeQueryWithParams($query, [$game_id]);
    return $result;
  }

  public function getModById($id) {
    $query = $this->db->prepare('select * from mods where id = ?');
    $result = $this->executeQueryWithParams($query, [$id]);
    if(!empty($result)) return $result[0] ?? null;
  }

  public function getModsByCreator($creator_id){
    $query = $this->db->prepare('select * from mods where creator_id = ?');
    return $this->executeQueryWithParams($query, [$creator_id]);
  }

  public function getModsByGameAndCategory($game_id, $category_id) {
    $query = $this->db->prepare('select * from mods where game_id = :game_id and category_id = :category_id');
    $result = $this->executeQueryWithParams($query, [':game_id' => $game_id, ':category_id' => $category_id]);
    return $result;
  }
}