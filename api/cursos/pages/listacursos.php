<?php

header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');


include_once $_SERVER['DOCUMENT_ROOT'] . '/vsc/api/config/database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/vsc/api/controller/Curso.php';



$database = new Database();
$db = $database->getConnection();


$cursos = new ListaCursos($db);
$page = $_GET['page'];
$list = $cursos->read($page);
$total = $cursos->total();
if ($list->rowCount() > 0) {

  http_response_code(200);
  $arr = array();
  $arr['response'] = array();
  $arr['total'] = $total;

  while ($row = $list->fetch(PDO::FETCH_ASSOC)) {
    $e = $row;
    array_push($arr['response'], $e);
    echo json_encode($arr);
  }
} else {
  http_response_code(200);
  echo json_encode(
    array(
      "type" => "danger",
      "title" => "Failed",
      "message" => "No records Found",
    )
  );
}