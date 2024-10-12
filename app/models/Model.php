<?php

class Model {
  protected $db;

  public function __construct() {
    try {
      $this->db = new PDO('mysql:host='. MYSQL_HOST . ';dbname='.MYSQL_DB.';charset=utf8', MYSQL_USER, MYSQL_PASS);
    } catch (Exception) {
      $this->createDB();
    }
    $this->deploy();
  }

  public function executeQuery($query) {
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
  }

  public function executeQueryWithParams($query, $params) {
    $query->execute($params);
    return $query->fetchAll(PDO::FETCH_OBJ);
  }

  public function createDB() {
    $sql_connection = "mysql:host=". MYSQL_HOST .";charset=utf8mb4";
    $pdo = new PDO($sql_connection, MYSQL_USER, MYSQL_PASS);
    $pdo->exec("CREATE DATABASE ". MYSQL_DB ." CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
    header('Location: ' . BASE_URL);
  }

  public function deploy() {
    $query = $this->db->query('SHOW TABLES');
    $tables = $query->fetchAll();
    if (count($tables) == 0) {
      $sql = file_get_contents('./modlog.sql');
      $sqlStatements = explode(";", $sql); 
      foreach ($sqlStatements as $statement) {
        if (trim($statement) != "") {
            $this->db->exec($statement);
        }
      }
    }
  }
}