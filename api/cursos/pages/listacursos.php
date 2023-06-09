<?php

header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');


include_once $_SERVER['DOCUMENT_ROOT'] . '/Sistema-Academico/api/config/database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Sistema-Academico/api/config/models.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Sistema-Academico/api/controller/QueryBuilder.php';

$database = new Database();
$db = $database->getConnection();


$cursos = new QueryBuilder($db, Curso::class);
$page = $_GET['page'];
$list = $cursos->list($page)->execute();
$total = $cursos->total()->execute();
if ($list->rowCount() > 0) {

  http_response_code(200);
  $arr = array();
  $arr['response'] = array();

  while ($row = $list->fetch(PDO::FETCH_ASSOC)) {
    $e = $row;
    array_push($arr['response'], $e);
  }
  while ($row = $total->fetch(PDO::FETCH_ASSOC)) {
    $e = $row;
    $arr['total'] = $e;
  }
  echo json_encode($arr);
} else {
  http_response_code(200);
  echo json_encode(
    array(
      "type" => "danger",
      "title" => "Failed",
      "message" => "No records to be Found",
    )
  );
}
