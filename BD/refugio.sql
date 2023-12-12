create database refugio;

use refugio;
CREATE TABLE usuario
(
    Id_Usuario INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
    Num_Tel VARCHAR(20),  
    Correo VARCHAR(70), 
    Contraseña VARCHAR(255) NOT NULL  
);

CREATE TABLE albergue
(
    Id_Albergue INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
    Num_Tel VARCHAR(20),  
    Direccion varchar (50),
    Correo VARCHAR(70), 
    Ciudad VARCHAR(255) NOT NULL  
);

CREATE TABLE animal (
    Id_Animal INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
    Tipo varchar (50),
    Raza VARCHAR(50) NOT NULL,
    Sexo varchar (50),
    Edad varchar(50),
    Tamaño Varchar (50),
    Descripcion TEXT,
    Id_Albergue INT,
    FOREIGN KEY (Id_Albergue)
	REFERENCES albergue (Id_Albergue)
);

CREATE TABLE usuario (
    Id_Usuario INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
    Correo VARCHAR(70) NOT NULL, 
    Contraseña VARCHAR(255) NOT NULL 
);


CREATE TABLE comentarios (
  id_comentario int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  comentario text not NULL
);
CREATE TABLE reg_com (
  id_comentario INT (11),
  registro datetime
);
CREATE TRIGGER comentarios_AI
AFTER UPDATE ON comentarios FOR EACH ROW
INSERT INTO reg_com (id_comentario , registro)
Values (NEW.id_comentario, Now());



CREATE TABLE reg_usu (
  Id_Usuario INT (11),
  Nombre varchar (50),
  Registro datetime
);

CREATE TRIGGER Usuario_AI AFTER INSERT ON usuario FOR EACH ROW
INSERT INTO reg_usu (Id_Usuario , Nombre, Registro)
VALUES (NEW.Id_Usuario, new.Nombre, Now());