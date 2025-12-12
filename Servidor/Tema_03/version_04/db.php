<?php

function conectarDB() {
    // Crear conexión PDO con SQLite
    $db = new PDO('sqlite:database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Activar claves foráneas en SQLite (importante para ON DELETE CASCADE)
    $db->exec("PRAGMA foreign_keys = ON;");

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
            password TEXT NOT NULL,
            email TEXT UNIQUE NOT NULL,
            idRol INTEGER NOT NULL,
            FOREIGN KEY (idRol) REFERENCES roles(idRol)
        );
    ");

    // Crear tabla de clientes (si ya existía no pasa nada)
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

    // Crear tabla de contactos (relacionada con clientes)
    $db->exec("
        CREATE TABLE IF NOT EXISTS contactos (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            idCliente INTEGER NOT NULL,
            nombre TEXT NOT NULL,
            apellidos TEXT NOT NULL,
            email TEXT NOT NULL,
            telefono TEXT NOT NULL,
            FOREIGN KEY (idCliente) REFERENCES clientes(id) ON DELETE CASCADE
        );
    ");

    // Insertar roles predeterminados si no existen
    $countRoles = $db->query("SELECT COUNT(*) FROM roles")->fetchColumn();
    if ($countRoles == 0) {
        $db->exec("INSERT INTO roles (descripcion) VALUES ('admin'), ('usuario');");
    }

    // Insertar usuario admin por defecto si no hay usuarios
    $countUsers = $db->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
    if ($countUsers == 0) {
        $idAdminRol = $db->query("SELECT idRol FROM roles WHERE descripcion = 'admin'")->fetchColumn();
        $passwordHash = password_hash('admin123', PASSWORD_DEFAULT);

        $stmt = $db->prepare("INSERT INTO usuarios (usuario, email, password, idRol) VALUES (?, ?, ?, ?)");
        $stmt->execute(['admin', 'admin@example.com', $passwordHash, $idAdminRol]);
    }

    return $db;
}
