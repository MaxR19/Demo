<?php
require_once 'init.php';

class Cliente {

    // Obtener todos los clientes
    public function obtenerTodos(): array {
        $db = conectarDB();
        $stmt = $db->query("SELECT * FROM clientes ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un cliente por ID
    public function obtenerPorId(int $id): ?array {
        $db = conectarDB();
        $stmt = $db->prepare("SELECT * FROM clientes WHERE id = ?");
        $stmt->execute([$id]);
        $c = $stmt->fetch(PDO::FETCH_ASSOC);
        return $c ?: null;
    }

    // Insertar un nuevo cliente
    public function insertar(string $nombre, string $apellidos, int $edad, string $email, string $documento): bool {
        try {
            $db = conectarDB();
            $stmt = $db->prepare("
                INSERT INTO clientes (nombre, apellidos, edad, email, documento)
                VALUES (?, ?, ?, ?, ?)
            ");
            return $stmt->execute([$nombre, $apellidos, $edad, $email, strtoupper($documento)]);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Modificar un cliente existente
    public function actualizar(int $id, string $nombre, string $apellidos, int $edad, string $email, string $documento): bool {
        try {
            $db = conectarDB();
            $stmt = $db->prepare("
                UPDATE clientes
                SET nombre = ?, apellidos = ?, edad = ?, email = ?, documento = ?
                WHERE id = ?
            ");
            return $stmt->execute([$nombre, $apellidos, $edad, $email, strtoupper($documento), $id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Eliminar un cliente por ID
    public function eliminar(int $id): bool {
        $db = conectarDB();
        $stmt = $db->prepare("DELETE FROM clientes WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

