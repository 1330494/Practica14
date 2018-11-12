
-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-11-2015 a las 18:03:49
-- Versión del servidor: 10.0.17-MariaDB
-- Versión de PHP: 5.6.14

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `practica14`
--
CREATE DATABASE practica14;

USE practica14;

-- --------------------------------------------------------
--
-- Estructura para la tabla `usuarios`
--

CREATE TABLE usuarios (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  usuario varchar(32) not null,
  password varchar(32) not null
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Estructura para la tabla `visitas`
--

CREATE TABLE visitas (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  id_cliente int(11) REFERENCES clientes(id),
  fecha DATE not null,
  hora TIME not null
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Estructura para la tabla `premios`
--

CREATE TABLE premios (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  nombre varchar(32) not null,
  descripcion varchar(512),
  puntos int(11) not null 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Estructura para la tabla `promociones`
--

CREATE TABLE promociones (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  nombre varchar(32) not null,
  descripcion varchar(512) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Estructura para la tabla `clientes`
--

CREATE TABLE clientes (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  nombre varchar(32) not null,
  apellidos varchar(32) not null,
  direccion varchar(256) not null,
  telefono varchar(10) not null,
  password varchar(16) not null,
  fecha_registro date not null,
  imagen varchar(128),
  puntos int(11) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Estructura para la tabla `servicios`
--

CREATE TABLE servicios (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  nombre varchar(32) not null,
  descripcion varchar(512) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*----------------------------------------------------------------------------*/
---        VOLCADO DE REGISTRO DE PRUEBA
/*----------------------------------------------------------------------------*/

--
-- Volcado de datos para la tabla `usuarios`
--
INSERT INTO usuarios (usuario, password) VALUES
('admin','admin'), ('luis','luis');

--
-- Volcado de datos para la tabla `servicios`
--
INSERT INTO servicios (nombre, descripcion) VALUES
('Lavado','Servicio de lavado de vehiculos.'), ('Afinacion','Servicio de afinacion de vehiculos.');

--
-- Volcado de datos para la tabla `premios`
--
INSERT INTO premios (nombre, descripcion, puntos) VALUES
('3 Washes 1 Free','3 visitas y recibe una lavada gratis', 3), ('Wash 30% Desc.','Descuento del 30% por apertura.', 1);

--
-- Volcado de datos para la tabla `promociones`
--
INSERT INTO promociones (nombre, descripcion) VALUES
('Amigo Wash','Invita un amigo a Kush Wash Co. y recibe un 25% descuento en la siguiente lavada.');

--
-- Volcado de datos para la tabla `clientes`
--
INSERT INTO clientes (nombre, apellidos, direccion, telefono, password, fecha_registro, puntos) VALUES
('Luis', 'Gomez Cordova','Calle Rayon #1231 Col. Altas Moras','8346545354','luis',CURDATE(),1),
('Yazmin', 'Roque Garcia','Calle Zarzamora #435 Col. Vista Hermosa','8311321092','roque',CURDATE(),1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
