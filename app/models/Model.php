<?php

class Model {
  protected $db;

  public function __construct() {
    require_once("./config/db.php");
    $this->db = new PDO('mysql:host='. $MYSQL_HOST . ';dbname='.$MYSQL_DB.';charset=utf8', $MYSQL_USER, $MYSQL_PASS);
  }
}