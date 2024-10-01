<?php 

require_once '../app/models/Model.php';

class usersModel extends Model {
  
  public function __construct() {
    parent::__construct();
  }

  public function getUserByName($name) {
    $query = $this->db->prepare('select * from users where username = :name');
    $result = $this->executeQueryWithParams($query, [':name' => $name]);
    return !empty($result) ? $result[0] : null;
  }
}