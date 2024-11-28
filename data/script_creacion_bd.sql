-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS Tienda_proyectoIV;
USE Tienda_proyectoIV;

-- Crear la tabla 'usuarios'
CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'usuario', 'moderador') NOT NULL,
    ultimo_acceso DATETIME
);

-- Crear la tabla 'productos'
CREATE TABLE IF NOT EXISTS productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    fecha_agregado DATE NOT NULL,
    categoria ENUM('electrónica', 'ropa', 'alimentos', 'muebles') NOT NULL,
    imagen BLOB,
    id_usuario_fk INT,
    FOREIGN KEY (id_usuario_fk) REFERENCES usuarios(id_usuario)
);

-- Crear la tabla 'pedidos'
CREATE TABLE IF NOT EXISTS pedidos (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario_fk INT,
    id_producto_fk INT,
    cantidad INT NOT NULL,
    fecha_pedido DATETIME NOT NULL,
    estado ENUM('pendiente', 'enviado', 'entregado', 'cancelado') NOT NULL,
    FOREIGN KEY (id_usuario_fk) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_producto_fk) REFERENCES productos(id_producto)
);
