<?php


class Curso {
  private string $codigo;
  private string $nome;
  private array $alunos;
  private array $disciplinas;
  private array $turmas;
  private string $table_name = "sistema_academico.cursos";
}

class Aluno {
  private string $matricula;
  private string $nome;
  private string $nome_social;
  private string $sobrenome;
  private string $genero;
  private string $curso;
  private Curso $cursoModel;
  private string $nascimento;
  private int $ano;
  private int $periodo;
  private bool $ativo;
  private string $table_name = "sistema_academico.alunos";
  private array $turmas;
}

class Professor {
  private string $matricula;
  private string $nome;
  private string $nome_social;
  private string $sobrenome;
  private string $genero;
  private bool $ativo;
  private string $table_name = "sistema_academico.professores";
}

class Disciplina {
  private string $codigo;
  private string $nome;
  private string $ementa;
  private string $curso;
  private Curso $cursoModel;
  private string $table_name = "sistema_academico.disciplinas";
}
Class Turma {
  private string $professor;
  private Professor $professorModel;
  private string $disciplina;
  private Disciplina $disciplinaModel;
  private array $alunos;
  private int $ano;
  private int $periodo;
  private string $horario1;
  private string $horario2;
  private string $horaria3;
  private string $horario4;
  private string $table_name = "sistema_academico.turmas";
}