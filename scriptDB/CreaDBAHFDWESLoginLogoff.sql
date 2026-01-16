/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/SQLTemplate.sql to edit this template
 */
/**
 * Author:  alejandro.huefer
 * Created: 20 nov. 2025
 */

CREATE DATABASE IF NOT EXISTS DBAHFDWESLoginLogoff;

USE DBAHFDWESLoginLogoff;

CREATE TABLE IF NOT EXISTS T_01Usuario (
    T01_CodUsuario VARCHAR(25) PRIMARY KEY,
    T01_Password VARCHAR(255) NOT NULL,
    T01_DescUsuario VARCHAR(255),
    T01_FechaHoraUltimaConexion DATETIME,
    T01_NumConexiones INT NOT NULL DEFAULT 0,
    T01_Perfil VARCHAR(25) default 'usuario',
    T01_ImagenUsuario VARCHAR(255)
    )engine=innodb;
    


CREATE TABLE IF NOT EXISTS T_02Departamento (
    T02_CodDepartamento VARCHAR(3) PRIMARY KEY, 
    T02_DescDepartamento VARCHAR(255),
    T02_FechaCreacionDepartamento datetime not null default now() ,
    T02_VolumenDeNegocio FLOAT,
    T02_FechaBajaDepartamento datetime default null)engine=innodb;


/* Creación del usuario y permisos */
CREATE USER IF NOT EXISTS "userAHFDWESLoginLogoff"@"%" IDENTIFIED by "paso";
GRANT ALL PRIVILEGES on *.* TO "userAHFDWESLoginLogoff"@"%" WITH GRANT OPTION;
FLUSH PRIVILEGES;
