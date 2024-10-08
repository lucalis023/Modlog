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

  public function create($data) {
    extract($data);
    $query = $this->db->prepare("INSERT INTO mods(game_id, category_id, creator_id, name, description, creation_date, github_link, download_link, image) VALUES (:game, :category, :creator, :name, :description, :creation_date, :github_link, :download_link, :image)");
    $this->executeQueryWithParams($query, [':game' => $game, ':category' => $category, ':creator' => $creator, ':name' => $name, ':description' => $description, ':creation_date' => $creation_date, ':github_link' => $github_link, ':download_link' => $download_link, ':image' => $image ?? null]);
  }

  public function update($data) {
    extract($data);
    $query = $this->db->prepare("UPDATE mods SET game_id=:game, category_id=:category, creator_id=:category, name=:name, description=:description, creation_date=:creation_date, github_link=:github_link, download_link=:download_link, image=:image WHERE id = :id");
    $this->executeQueryWithParams($query, [':game' => $game, ':category' => $category, ':creator' => $creator, ':name' => $name, ':description' => $description, ':creation_date' => $creation_date, ':github_link' => $github_link, ':download_link' => $download_link, ':image' => $image ?? null, ':id' => $id]);
  }

  public function delete($id) {
    $query = $this->db->prepare("DELETE FROM mods WHERE id = :id");
    $this->executeQueryWithParams($query, [':id' => $id]);
  }
}