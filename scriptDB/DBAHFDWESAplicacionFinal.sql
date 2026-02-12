/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/SQLTemplate.sql to edit this template
 */
/**
 * Author:  aleja
 * Created: 26 nov 2025
 */

CREATE DATABASE IF  NOT EXISTS DBAHFDWESAplicacionFinal;
USE DBAHFDWESAplicacionFinal;

CREATE TABLE IF NOT EXISTS T_01Usuario (
                     T01_CodUsuario VARCHAR(15) PRIMARY KEY,
                     -- CodUsuario:8 letras maximo y 4 ninimo PK
                     T01_Password VARCHAR(256) NOT NULL ,
                     -- Password:8 letras maximo y 4 ninimo. Obligatorio
                     T01_DescUsuario VARCHAR(255),
                     -- Alfanuemrico hasta 255 caracteres.Nombre y Apeliido del usuario. Obligatorio
                     T01_FechaHoraUltimaConexion DATETIME DEFAULT NULL,
                     -- Fecha y hora de la ultima conexion del usuario. Valor automatico al conectarse. Obligatorio
                     T01_NumConexiones INT NOT NULL DEFAULT 0,
                     T01_Perfil VARCHAR(25) default 'usuario',
                     -- Valor usuario por defecto (podría ser usuario o adminsitrador). default (LOWER('usuario')
                     T01_ImagenUsuario MEDIUMBLOB default null)engine=innodb;
                     /*En este caso voy a guradar el nombre del archivo pero 
                     las fotos se puede guardar en la base de datos como tal, en este caso :
                     T01_ImagenUsuario BLOB, ( que serían fotos hastas 64KB)
                     T01_ImagenUsuario MEDIUMBLOB, ( que serían fotos hastas 16MB)
                     T01_ImagenUsuario LONGBLOB, ( que serían fotos hastas 4GB).*/


CREATE TABLE IF NOT EXISTS T_02Departamento (
                     T02_CodDepartamento VARCHAR(3) PRIMARY KEY, 
                     T02_DescDepartamento VARCHAR(255),
                     T02_FechaCreacionDepartamento datetime not null default now() ,
                     T02_VolumenDeNegocio FLOAT,
                     T02_FechaBajaDepartamento datetime default null)engine=innodb;
                     
                     


USE DBAHFDWESAplicacionFinal;

INSERT INTO T_01Usuario (T01_CodUsuario,T01_Password,T01_DescUsuario,T01_ImagenUsuario)
                VALUES
            ('vero',SHA2('veropaso',256),'Véro Grué',null),
            ('heraclio',SHA2('heracliopaso',256),'Heraclio Borbujo',null),
            ('alvaroA',SHA2('alvaroApaso',256),'Alvaro Allen',null),
            ('alejandro',SHA2('alejandropaso',256),'Alejandro De La Huerga',null),
            ('alvaroG',SHA2('alvaroGpaso',256),'Alvaro García',null),
            ('gonzalo',SHA2('gonzalopaso',256),'Gonzalo Junquera',null),
            ('cristian',SHA2('cristianpaso',256),'Cristian Mateos',null),
            ('alberto',SHA2('albertopaso',256),'Alberto Méndez',null),
            ('enrique',SHA2('enriquepaso',256),'Enrique Nieto',null),
            ('james',SHA2('jamespaso',256),'James Edward Nuñez',null),
            ('oscar',SHA2('oscarpaso',256),'Oscar Pozuelo',null),
            ('jesus',SHA2('jesuspaso',256),'Enrique Nieto',null),
            ('amor',SHA2('amorpaso',256),'Amor Rodriguez',null),
            ('albertoB',SHA2('albertoBpaso',256),'Alberto Bahillo',null),
            ('antonio',SHA2('antoniopaso',256),'Antonio Jañez',null),
            ('jorge',SHA2('jorgepaso',256),'Jorge Corral',null),
            ('claudio',SHA2('claudiopaso',256),'Claudio Lozano',null),
            ('gisela',SHA2('giselapaso',256),'Gisela Folgueral',null)
;


INSERT INTO T_02Departamento (T02_CodDepartamento,T02_DescDepartamento,T02_FechaCreacionDepartamento,T02_VolumenDeNegocio,T02_FechaBajaDepartamento)
                 VALUES 
            ('INF','informática',now(),1285.50,NULL),
            ('LEN','Lengua',now(),2285.50,NULL),
            ('MAT','Matemáticas',now(),3285.50,'2025-05-25'),
            ('ING','Inglès',now(),2285.50,NULL),
            ('FIS','Física',now(),2285.50,NULL);

