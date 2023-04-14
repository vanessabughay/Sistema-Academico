<?php


include_once $_SERVER['DOCUMENT_ROOT'] . '/Sistema-Academico/api/config/models.php';

class QueryBuilder
{
  private $conn;
  private $query = "";
  private \ReflectionClass $reflector;
  private $table_name;
  private $where;
  public function __construct($db, $class)
  {
    $this->conn = $db;
    $this->reflector = new \ReflectionClass($class);
    $this->table_name = $this->reflector->getDefaultProperties()['table_name'];
  }

  public function execute(){
    echo $this->query;
    $statement = $this->conn->prepare($this->query);
    $statement->execute();
    return $statement;
  }

  public function list($page)
  {
    $this->query = "SELECT * from " .
      $this->table_name ." order by nome asc limit 50 offset " .
      50 * ($page - 1);
      return $this;
  }

  public function total()
  {
    $this->query = "SELECT count(codigo) from " . $this->table_name;
    return $this;
  }
  public function findOne() {
    $this->query = "SELECT from" .$this->table_name;
  }

}
