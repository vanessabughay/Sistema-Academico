<?php

header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');


include_once $_SERVER['DOCUMENT_ROOT'] . '/Sistema-Academico/api/config/database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Sistema-Academico/api/config/models.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Sistema-Academico/api/controller/QueryBuilder.php';

$database = new Database();
$db = $database->getConnection();

$join = ['table' => 'sistema_academico.disciplinas', 'as' => 'disc', 'on' => 'disc.curso = sistema_academico.cursos.codigo'];
$where = ['codigo'=> 1];
$cursos = new QueryBuilder($db, Curso::class);

$list = $cursos->findOne()->where('Curso_codigo = :codigo', $where)->leftJoin($join)->execute();
if ($list->rowCount() > 0) {

  http_response_code(200);
  $arr = array();
  $arr['response'] = array();

  while ($row = $list->fetch(PDO::FETCH_ASSOC)) {
    $e = $row;
    array_push($arr['response'], $e);
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
