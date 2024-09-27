<?php 
require_once __DIR__ . '/Model.php';

class creatorsModel extends Model {

  public function __construct() {
    parent::__construct();
  }

  public function getCreatorById($id) {
    $query = $this->db->prepare('select id, name from creators where id = ?');
    $result = $this->executeQueryWithParams($query, [$id]);
    if (!empty($result)) return $result[0];
  }
}