<?php 
require_once './app/models/Model.php';

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

  public function create($data) {
    extract($data);
    $query = $this->db->prepare("INSERT INTO games(name, mods_ammount, description, image) VALUES (:name, 0, :description, :image)");
    $this->executeQueryWithParams($query, [':name' => $name, ':description' => $description, ':image' => $image ?? null]);
  }

  public function update($data) {
    extract($data);
    $query = $this->db->prepare("UPDATE games SET name=:name, description=:description, image=:image WHERE id = :id");
    $this->executeQueryWithParams($query, [':name' => $name, ':description' => $description, ':image' => $image ?? null, ':id' => $id]);
  }

  public function delete($id) {
    $query = $this->db->prepare("DELETE FROM `games` WHERE id = :id");
    $this->executeQueryWithParams($query, [':id' => $id]);
  }
}