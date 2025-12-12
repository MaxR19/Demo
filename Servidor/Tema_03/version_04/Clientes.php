<?php
require_once 'init.php';

class Cliente {

    public function obtenerTodos(): array {
        $db = conectarDB();
        $stmt = $db->query("SELECT * FROM clientes ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId(int $id): ?array {
        $db = conectarDB();
        $stmt = $db->prepare("SELECT * FROM clientes WHERE id = ?");
        $stmt->execute([$id]);
        $c = $stmt->fetch(PDO::FETCH_ASSOC);
        return $c ?: null;
    }

    public function insertar(string $nombre, string $apellidos, int $edad, string $email, string $documento): bool {
        try {
            $db = conectarDB();
            $stmt = $db->prepare("
                INSERT INTO clientes (nombre, apellidos, edad, email, documento)
                VALUES (?, ?, ?, ?, ?)
            ");
            return $stmt->execute([$nombre, $apellidos, $edad, $email, strtoupper(trim($documento))]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function actualizar(int $id, string $nombre, string $apellidos, int $edad, string $email, string $documento): bool {
        try {
            $db = conectarDB();
            $stmt = $db->prepare("
                UPDATE clientes
                SET nombre = ?, apellidos = ?, edad = ?, email = ?, documento = ?
                WHERE id = ?
            ");
            return $stmt->execute([$nombre, $apellidos, $edad, $email, strtoupper(trim($documento)), $id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function eliminar(int $id): bool {
        $db = conectarDB();
        $stmt = $db->prepare("DELETE FROM clientes WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
