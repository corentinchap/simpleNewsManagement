<?php
class DBHandler
{
  private $db;

  function __construct()
  {
    $this->connect_database();
  }

  public function getInstance()
  {
    return $this->db;
  }

  private function connect_database()
  {
    define('USER', 'user');
    define('PASSWORD', 'password');

  

    // Database connection
    try {
      $connection_string = 'mysql:host=pj87y.myd.infomaniak.com;dbname=pj87y_dbnews;charset=utf8';
      $connection_array = array(
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
      );

      $this->db = new PDO($connection_string, USER, PASSWORD, $connection_array);
    } catch (PDOException $e) {
      print($e);
      $this->db = null;
    }
  }
}