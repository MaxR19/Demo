<?php

require_once './clases/Clientes.php';
require_once './clases/Contactos.php';
require_once './clases/Roles.php';
require_once './clases/Usuarios.php';

/* 
Este archivo define la función conectarDB(), que crea una conexión PDO a una base de datos SQLite, crea las tablas necesarias 
si no existen e inserta registros predeterminados.
*/
function conectarDB() {
    // Crear conexión PDO con SQLite
    $db = new PDO('sqlite:./bbdd/database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear tabla de roles
    $db->exec("
        CREATE TABLE IF NOT EXISTS roles (
            idRol INTEGER PRIMARY KEY AUTOINCREMENT,
            descripcion TEXT UNIQUE NOT NULL
        );
    ");

    // Crear tabla de usuarios
    $db->exec("
        CREATE TABLE IF NOT EXISTS usuarios (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            usuario TEXT UNIQUE NOT NULL,
            email TEXT UNIQUE NOT NULL,
            password TEXT NOT NULL,
            nombre TEXT NOT NULL,
            apellidos TEXT NOT NULL,
            idRol INTEGER NOT NULL,
            FOREIGN KEY (idRol) REFERENCES roles(idRol)
        );
    ");

    // Crear tabla de clientes
    $db->exec("
        CREATE TABLE IF NOT EXISTS clientes (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nombre TEXT NOT NULL,
            apellidos TEXT NOT NULL,
            edad INTEGER NOT NULL,
            email TEXT NOT NULL UNIQUE,
            documento TEXT NOT NULL UNIQUE
        );
    ");

    // Crear tabla de contactos
    $db->exec("
        CREATE TABLE IF NOT EXISTS contactos (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nombre TEXT NOT NULL,
            apellidos TEXT NOT NULL,
            email TEXT NOT NULL UNIQUE,
            numTelefono TEXT NOT NULL UNIQUE,
            idCliente INTEGER NOT NULL,
            FOREIGN KEY (idCliente) REFERENCES clientes(id)
        );
    ");


    // Insertar los roles predeterminados (admin y usuario) solo si no existen
    $countRoles = $db->query("SELECT COUNT(*) FROM roles")->fetchColumn();
    if ($countRoles == 0) {
        $db->exec("
            INSERT INTO roles (descripcion)
            VALUES ('admin'), ('usuario');"
        );
    }

    
    $countUsers = $db->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
    if ($countUsers == 0) {
        // Consulta para la inserción de los usuarios por defecto
        $stmt = $db->prepare("
            INSERT INTO usuarios (usuario, password, email, nombre, apellidos, idRol) 
            VALUES (:usuario, :password, :email, :nombre, :apellidos, :rol_id)"
        );

        // Hashear las contraseñas de los usuarios por defecto
        $passwordAdmin = password_hash('admin123', PASSWORD_DEFAULT);
        $passwordUser = password_hash('user123', PASSWORD_DEFAULT);

        // Insertar los usuarios por defecto
        $stmt->execute(
            [':usuario' => 'admin',
            ':password' => $passwordAdmin,
            ':email' =>  'admin@example.com',
            ':nombre' => 'Usuario',
            ':apellidos' => 'Administrador',
            ':rol_id' => 1]
        );

        $stmt->execute(
            [':usuario' => 'user',
            ':password' => $passwordUser,
            ':email' =>  'user@example.com',
            ':nombre' => 'Usuario',
            ':apellidos' => 'Estándar',
            ':rol_id' => 2]
        );
    }

    return $db;
}