drop database if exists control_registros;
create database control_registros;
use control_registros;

create table if not exists alumnos(
    id integer not null auto_increment,
    nombre varchar(255) not null,
    apellidos varchar(255) not null,
    edad tinyint not null,
    telefono_1 varchar(12) not null,
    telefono_2 varchar(12) not null,
    primary key (id)
);

create table if not exists talleres(
    id integer not null auto_increment,
    nombre_taller varchar(255) not null,
    hora_inicio timestamp,
    hora_fin timestamp,
    primary key (id)
);

create table if not exists instrumentos(
    id integer not null auto_increment,
    nombre_instrumento varchar(255) not null,
    marca varchar(255) not null,
    modelo varchar(255),
    primary key (id)
);

create table if not exists registros(
    id integer not null auto_increment,
    tipo_registro varchar(255) not null,
    descripcion varchar(255) not null,
    primary key (id),
    alumno_id integer,
    taller_id integer,
    intrumento_id integer,
    foreign key (alumno_id) references alumnos(id) on delete cascade on update cascade,
    foreign key (taller_id) references talleres(id) on delete cascade on update cascade,
    foreign key (intrumento_id) references instrumentos(id) on delete cascade on update cascade
);