<?php
function conectarDB() {
    $db = new PDO('sqlite:database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear tabla si no existe
    $db->exec("
        CREATE TABLE IF NOT EXISTS usuarios (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            usuario TEXT UNIQUE NOT NULL,
            password TEXT NOT NULL,
            rol TEXT CHECK(rol IN ('admin', 'usuario')) NOT NULL
        );
    ");

    // Insertar usuarios iniciales si no existen
    $stmt = $db->prepare("SELECT COUNT(*) FROM usuarios");
    if ($stmt->execute() && $stmt->fetchColumn() == 0) {
        $insert = $db->prepare("INSERT INTO usuarios (usuario, password, rol) VALUES (?, ?, ?)");
        $insert->execute(['admin', 'admin123', 'admin']);
        $insert->execute(['usuario', 'usuario123', 'usuario']);
    }

    return $db;
}
