<?php 

require_once '../app/models/Model.php';

class usersModel extends Model {
  
  public function __construct() {
    parent::__construct();
  }

  public function isNameinDB($user) {
    $query = $this->db->prepare('select username from users where username = :name');
    $result = $this->executeQueryWithParams($query, [':name' => $user]);
    return (!empty($result));
  }

  public function getUser($user, $pass) {
    $query = $this->db->prepare('select username, id from users where username = :user and password = :pass');
    $result = $this->executeQueryWithParams($query, [':user' => $user, ':pass' => $pass]);
    return !empty($result) ? $result[0] : null;
  }
}