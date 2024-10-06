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

  public function getCategories() {
    $query = $this->db->prepare('select * from categories');
    $result = $this->executeQuery($query);
    return $result;
  }

  public function create($data) {
    extract($data);
    $query = $this->db->prepare("INSERT INTO categories(name, id_game) VALUES (:name, :id_game)");
    $this->executeQueryWithParams($query, [':name' => $name, ':id_game' => $game]);
  }

  public function update($data) {
    extract($data);
    $query = $this->db->prepare("UPDATE categories SET name=:name WHERE id = :id");
    $this->executeQueryWithParams($query, [':name' => $name, ':id' => $id]);
  }

  public function delete($id) {
    $query = $this->db->prepare("DELETE FROM categories WHERE id = :id");
    $this->executeQueryWithParams($query, [':id' => $id]);
  }
}