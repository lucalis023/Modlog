<?php 
require_once '../app/models/Model.php';

class creatorsModel extends Model {

  public function __construct() {
    parent::__construct();
  }

  public function getCreatorById($id) {
    $query = $this->db->prepare('select * from creators where id = ?');
    $result = $this->executeQueryWithParams($query, [$id]);
    if (!empty($result)) return $result[0];
  }

  public function getCreators() {
    $query = $this->db->prepare('select * from creators');
    $result = $this->executeQuery($query);
    return $result;
  }

  public function create($data) {
    extract($data);
    $query = $this->db->prepare("INSERT INTO creators(name, profile_link) VALUES (:name, :link)");
    $this->executeQueryWithParams($query, [':name' => $name, ':link' => $link]);
  }

  public function update($data) {
    extract($data);
    $query = $this->db->prepare("UPDATE creators SET name=:name, profile_link=:link WHERE id = :id");
    $this->executeQueryWithParams($query, [':name' => $name, ':link' => $link, ':id' => $id]);
  }

  public function delete($id) {
    $query = $this->db->prepare("DELETE FROM creators WHERE id = :id");
    $this->executeQueryWithParams($query, [':id' => $id]);
  }
}