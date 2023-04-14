create table if not exists sistema_academico.cursos(
codigo bigint primary key auto_increment,
nome varchar(50) not null
);

create table if not exists sistema_academico.alunos (
matricula bigint primary key auto_increment,
nome varchar(40) not null,
sobrenome varchar(40) not null,
nome_social varchar(40),
genero varchar(1) not null,
curso bigint not null,
ano smallint,
periodo smallint,
nascimento date,
ativo bool not null default 1,
foreign key (curso) references sistema_academico.cursos(codigo)
);

create table if not exists sistema_academico.professores (
matricula bigint primary key auto_increment,
nome varchar(40) not null,
sobrenome varchar(40) not null,
nome_social varchar(40),
genero varchar(1) not null,
ativo bool
);

create table if not exists sistema_academico.disciplinas (
codigo bigint primary key auto_increment,
nome varchar(40) not null,
ementa varchar(100) not null,
curso bigint not null,
foreign key (curso) references sistema_academico.cursos(codigo)
);

create table if not exists sistema_academico.professor_disciplina (
id bigint primary key auto_increment,
professor bigint not null,
disciplina bigint not null,
foreign key (professor) references sistema_academico.professores(matricula),
foreign key (disciplina) references sistema_academico.disciplinas(codigo)
);

create table if not exists sistema_academico.turmas (
id bigint primary key auto_increment,
professor_disciplina bigint not null,
curso bigint not null,
horario1 varchar(7) not null,
horario2 varchar(7),
horario3 varchar(7),
horario4 varchar(7),
ano smallint not null,
periodo smallint not null,
foreign key (curso) references sistema_academico.cursos(codigo),
foreign key (professor_disciplina) references sistema_academico.professor_disciplina(id)
);

create table if not exists sistema_academico.registros_turmas_alunos (
id bigint primary key auto_increment,
aluno bigint not null,
turma bigint not null,
status varchar(1),
nota smallint
);