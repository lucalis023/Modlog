<?php
require_once '../app/models/Model.php';

class categoriesModel extends Model {
  
  public function __construct() {
    parent::__construct();
  }

  public function getCategoryById($id) {
    $query = $this->db->prepare('select * from categories where id = ?');
    $result = $this->executeQueryWithParams($query, [$id]);
    if (!empty($result)) return $result[0];
  }

  public function getCategoriesByGame($game_id) {
    $query = $this->db->prepare('select * from categories where id_game = ?');
    $result = $this->executeQueryWithParams($query, [$game_id]);
    return $result;
  }
}