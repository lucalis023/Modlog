<?php

class Model {
  protected $db;

  public function __construct() {
    $this->db = new PDO('mysql:host='. MYSQL_HOST . ';dbname='.MYSQL_DB.';charset=utf8', MYSQL_USER, MYSQL_PASS);
  }

  public function executeQuery($query) {
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
  }

  public function executeQueryWithParams($query, $params) {
    $query->execute($params);
    return $query->fetchAll(PDO::FETCH_OBJ);
  }
}