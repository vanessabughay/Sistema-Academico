<?php


include_once $_SERVER['DOCUMENT_ROOT'] . '/Sistema-Academico/api/config/models.php';

class QueryBuilder
{
  private $conn;
  private $query = "";
  private \ReflectionClass $reflector;
  private $table_name;
  private $conditions = [];



  public function __construct($db, $class)
  {
    $this->conn = $db;
    $this->reflector = new \ReflectionClass($class);
    $this->table_name = $this->reflector->getDefaultProperties()['table_name'];
  }

  public function execute()
  {
    $toWhere =  implode(" ", $this->conditions);
    $this->query = $this->query . " " . $toWhere . ";";
    echo $this->query;
    $statement = $this->conn->prepare($this->query);
    $statement->execute();
    return $statement;
  }

  public function list($page)
  {
    $this->query = "SELECT * from " .
      $this->table_name . " order by nome asc limit 50 offset " .
      50 * ($page - 1);
    return $this;
  }

  public function total()
  {
    $this->query = "SELECT count(codigo) from " . $this->table_name;
    return $this;
  }
  public function findOne()
  {
    $this->query = "SELECT from" . $this->table_name;
  }

  function where(string $condition, $params)
  {
    foreach ($params as $key => $value) {
      $condition = str_replace(":{$key}", is_numeric($value) ? "{$value}" : "'{$value}'", $condition);
    }
    $this->conditions = ["WHERE {$condition}"];
    return $this;
  }

  function andWhere(string $condition, $params)
  {
    foreach ($params as $key => $value) {
      $condition = str_replace(":{$key}", is_numeric($value) ? "{$value}" : "'{$value}'", $condition);
    }
    array_push($this->conditions, "AND {$condition}");
    return $this;
  }

  function orWhere(string $condition, $params)
  {
    foreach ($params as $key => $value) {
      $condition = str_replace(":{$key}", is_numeric($value) ? "{$value}" : "'{$value}'", $condition);
    }
    array_push($this->conditions, "OR {$condition}");
    return $this;
  }

  public function save($class, $type = null)
  {
    $rp = $this->reflector->getProperties();
    $values = [];
    $set = [];
    $values = [];
    $update = [];
    foreach ($rp as $property) {
      if ($property->isInitialized($class) && $property->name != "table_name") {
        $name = $property->name;
        $snakeName = $name;
        $nullValue = $class->$name != null ? (is_numeric($class->$name) ? "{$class->$name}" : "'{$class->$name}'") : "NULL";
        array_push($set, $snakeName);
        array_push($values, $nullValue);
        array_push($update, " {$snakeName} = {$nullValue}");
      }
    }
    $className = $this->table_name;
    switch ($type) {
      case ("INSERT"):
        $toSet = implode(", ", $set);
        $toValues = implode(", ", $values);
        $this->query = "INSERT INTO {$className} ({$toSet}) VALUES ({$toValues})";
        return $this;
      case ("UPDATE"):
        $toUpdate = implode(", ", $update);
        $this->query = "UPDATE {$className} SET {$toUpdate} ";
        return $this;
      default:
        $toSet = implode(", ", $set);
        $toValues = implode(", ", $values);
        $toUpdate = implode(", ", $update);
        $this->query =  "INSERT INTO {$className} ({$toSet}) VALUES ({$toValues}) ON DUPLICATE KEY UPDATE {$className} SET {$toUpdate}";
        return $this;
    }
  }
  public function delete()
  {
    $className = $this->table_name;
    $this->query = "DELETE FROM {$className}";
    return $this;
  }
  public function insert($class)
  {
    return $this->save($class, "INSERT");
  }
  public function update($class)
  {
    return $this->save($class, "UPDATE");
  }
}
