<?php


class Database
{
  private $host = "localhost";
  private $username = "root";
  private $password = "";
  private $port = "3306";
  public $conn;

  public function getConnection()
  {
    $this->conn = null;
    try {
      $this->conn = new PDO(
        "mysql:host=" . $this->host . ";
        port=" . $this->port,
        $this->username,
        $this->password
      );
    } catch (PDOException $exception) {
      echo "Database not found:" . $exception->getMessage();
    }
    return $this->conn;
  }
}
