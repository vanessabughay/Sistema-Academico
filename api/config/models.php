<?php


class Curso
{
  public string $codigo;
  public string $nome;
  public array $alunos;
  public array $disciplinas;
  public array $turmas;
  public string $table_name = "sistema_academico.cursos";
}

class Aluno
{
  public string $matricula;
  public string $nome;
  public string $nome_social;
  public string $sobrenome;
  public string $genero;
  public string $curso;
  public Curso $cursoModel;
  public string $nascimento;
  public int $ano;
  public int $periodo;
  public bool $ativo;
  public string $table_name = "sistema_academico.alunos";
  public array $turmas;
}

class Professor
{
  public string $matricula;
  public string $nome;
  public string $nome_social;
  public string $sobrenome;
  public string $genero;
  public bool $ativo;
  public string $table_name = "sistema_academico.professores";
}

class Disciplina
{
  public string $codigo;
  public string $nome;
  public string $ementa;
  public string $curso;
  public Curso $cursoModel;
  public string $table_name = "sistema_academico.disciplinas";
}
class Turma
{
  public string $professor;
  public Professor $professorModel;
  public string $disciplina;
  public Disciplina $disciplinaModel;
  public array $alunos;
  public int $ano;
  public int $periodo;
  public string $horario1;
  public string $horario2;
  public string $horaria3;
  public string $horario4;
  public string $table_name = "sistema_academico.turmas";
}
