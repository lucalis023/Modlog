<?php
require_once __DIR__ . '/Model.php';

class categoriesModel extends Model {
  
  public function __construct() {
    parent::__construct();
  }

  public function getCategoryById($id) {
    $query = $this->db->prepare('select * from categories where id = ?');
    $result = $this->executeQueryWithParams($query, [$id]);
    if (!empty($result)) return $result[0];
  }
}