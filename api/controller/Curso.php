<?php


include_once $_SERVER['DOCUMENT_ROOT'] . '/vsc/api/config/models.php';

class ListaCursos extends Databasenames
{
  private $conn;
  public function __construct($db)
  {
    $this->conn = $db;
  }
  public function read($page)
  {
    $query = "SELECT * from " .
      $this->curso . " order by nome asc limit 50 offset " .
      50 * ($page - 1);

    $statement = $this->conn->prepare($query);
    $statement->execute();
    return $statement;
  }
  public function total()
  {
    $query = "SELECT count(codigo) from " . $this->curso;
    $statement = $this->conn->prepare($query);
    $statement->execute();
    return $statement;
  }

  public function listaTurmas($codigo)
  {
    $query = "Select cur.nome as Curso,
    cur.codigo as Codigo, 
    dis.nome as disciplina, 
    dis.codigo as discodigo,
    tur.horario1, tur.horario2, 
    tur.horario3, tur.horario4,
    tur.ano as ano, tur.periodo as periodo,
    prof.nome as discente, prof.matricula as idprof
    from " . $this->turma . " tur 
    left join " . $this->professor_disciplina . " profdi on profdi.id = tur.professor_disciplina
    left join " . $this->professor . " prof on prof.matricula = profdi.professor
    left join " . $this->disciplina . " dis on dis.codigo = profdi.disciplina
    left join " . $this->curso . " cur on cur.codigo = dis.curso
    where cur.codigo = " . $codigo . " order by tur.ano desc, tur.periodo desc";
    $statement = $this->conn->prepare($query);
    $statement->execute();
    return $statement;
  }
  public function listaDisciplinas($codigo)
  {
    $query = "Select 
    cur.nome as Curso,
    cur.codigo as Codigo, dis.nome as disciplina, 
    dis.codigo as discodigo,
    dis.curso from " . $this->curso . " cur left join " . $this->disciplina . " dis on dis.curso = cur.codigo where cur.codigo = " . $codigo;
    $statement = $this->conn->prepare($query);
    $statement->execute();
    return $statement;
  }
}
