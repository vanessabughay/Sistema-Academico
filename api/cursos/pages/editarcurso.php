<?php



header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');


include_once $_SERVER['DOCUMENT_ROOT'] . '/Sistema-Academico/api/config/database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Sistema-Academico/api/config/models.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Sistema-Academico/api/controller/QueryBuilder.php';



$database = new Database();
$db = $database->getConnection();


$form = $_POST;
$cursoToSave = new Curso;
foreach ($form as $key => $value) {
  $cursoToSave->$key = $value;
};
$cursos = new QueryBuilder($db, Curso::class);
$cursos->update($cursoToSave)->where("codigo = :codigo", ['codigo' => $cursoToSave->codigo])->execute();
