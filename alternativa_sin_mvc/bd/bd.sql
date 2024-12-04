-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS Tienda_proyectoIV;
USE Tienda_proyectoIV;

-- Crear la tabla 'usuarios'
CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'usuario') NOT NULL,
    ultimo_acceso DATETIME
);

-- Crear la tabla 'categorias'
CREATE TABLE IF NOT EXISTS categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion VARCHAR(255)
);

-- Crear la tabla 'productos'
CREATE TABLE IF NOT EXISTS productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion VARCHAR(255),
    precio DECIMAL(10, 2) NOT NULL,
    imagen BLOB,
    tipo_producto ENUM('electrónica', 'ropa', 'alimentos', 'muebles','otros') NOT NULL,
    fecha_caducidad DATE,
    stock INT DEFAULT 0,
    id_categoria INT NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
);
