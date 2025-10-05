/**
 * bdusuarios.sql
 * Script de creación de la base de datos.
 */

/** Borra la base de datos si existe. */
drop database if exists BDUsuarios;

/** Crea la base de datos. */
create database BDUsuarios;

/** Crea el usuario para acceder a la base de datos. */
create or replace user 'UBDUsuarios'@'localhost' 
    identified by 'Lo-1234-lo';

/** Concede privilegios al usuario para acceder a la base de datos. */
grant select, insert, update, delete on BDUsuarios.* 
    to 'UBDUsuarios'@'localhost';

/** Selecciona la base de datos. */
use BDUsuarios;

/** Crea las tablas. */
create table Usuario (
        idUsuario int primary key auto_increment,
	email varchar(40),
	contraseña varchar(15) not null,
	nombre varchar(50) not null,
        fechaNacimiento varchar(10) not null,
        sexo varchar (1) not null
);

create table UsuarioExtendido(
        idUsuarioExtendido int primary key auto_increment,
        foto varchar(500),
        estado varchar(140),
        redes varchar (500),
        informacion varchar (500),
        foreign key (idUsuarioExtendido) 
        references Usuario(idUsuario) 
        on delete cascade
        on update cascade
);

create table Galeria(
        idGaleria int primary key auto_increment,
        idUsuarioExtendido int,
        fotoUsuario varchar(500),
        foreign key (idUsuarioExtendido) 
        references UsuarioExtendido(idUsuarioExtendido) 
        on delete cascade
        on update cascade
);

create table Peticiones (
        idAmistad int primary key auto_increment,
        idUsuario1 int not null,
        idUsuario2 int not null,
        estado varchar (10),
        fechaSolicitud datetime not null,
        foreign key (idUsuario1) 
        references usuario(idUsuario) 
        on delete cascade,
        foreign key (idUsuario2) 
        references usuario(idUsuario) 
        on delete cascade 
        on update cascade
);

create table Amigos (
        idAmigo int not null,
        codUsuario1 int not null,
        codUsuario2 int not null,
        fechaAmistad datetime not null,
        primary key (idAmigo, codUsuario1, codUsuario2),  -- Clave primaria compuesta si es necesario
        foreign key (idAmigo) 
        references Peticiones(idAmistad),
        foreign key (codUsuario1) 
        references Usuario(idUsuario),
        foreign key (codUsuario2) 
        references Usuario(idUsuario) 
);

/** Carga inicial de datos. */

insert into Usuario (idUsuario, email, contraseña, nombre, fechaNacimiento, sexo)
Values (1,'sergioescuderomartinez@gmail.com','1234Abcd','xixilove93','1993-11-30','H');
insert into Usuario (idUsuario, email, contraseña, nombre, fechaNacimiento, sexo)
Values (2,'rebecamanzano@gmail.com','1234Abcd','rebecamanzano39','1997-11-30','M');

insert into UsuarioExtendido (foto, estado, redes, informacion)
Values ('../capaPresentacion/img/man.jpeg','La tranquilidad es lo que mas se busca','@sergioem93','Me gusta el flamenquito y el regateon');
insert into UsuarioExtendido (foto, estado, redes, informacion)
Values ('../capaPresentacion/img/redhead.jpeg','Buscando el Norte','@rebecamanzano39','Me gusta el chocolate con churros');
