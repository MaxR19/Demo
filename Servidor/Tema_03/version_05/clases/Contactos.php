<?php
require_once 'init.php';

class Contacto {

    // Obtener todos los contactos
    public function obtenerTodos(): array {
        $db = conectarDB();
        $stmt = $db->query("SELECT * FROM contactos ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener todos los contactos de un cliente
    public function obtenerTodosPorCliente(int $idCliente): array {
        $db = conectarDB();
        $stmt = $db->query("SELECT * FROM contactos INNER JOIN clientes WHERE idCliente = ? ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un contacto por ID
    public function obtenerPorId(int $id): ?array {
        $db = conectarDB();
        $stmt = $db->prepare("SELECT * FROM contactos WHERE id = ?");
        $stmt->execute([$id]);
        $c = $stmt->fetch(PDO::FETCH_ASSOC);
        return $c ?: null;
    }

    // Insertar un contacto cliente
    public function insertar(string $nombre, string $apellidos, int $edad, string $email, string $documento): bool {
        try {
            $db = conectarDB();
            $stmt = $db->prepare("
                INSERT INTO contactos (nombre, apellidos, email, numTelefono)
                VALUES (?, ?, ?, ?, ?)
            ");
            return $stmt->execute([$nombre, $apellidos, $edad, $email, strtoupper($documento)]);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Modificar un contacto existente
    public function actualizar(int $id, string $nombre, string $apellidos, int $edad, string $email, string $documento): bool {
        try {
            $db = conectarDB();
            $stmt = $db->prepare("
                UPDATE contactos
                SET nombre = ?, apellidos = ?, email = ?, numTelefono = ?
                WHERE id = ?
            ");
            return $stmt->execute([$nombre, $apellidos, $edad, $email, strtoupper($documento), $id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Eliminar un contacto por ID
    public function eliminar(int $id): bool {
        $db = conectarDB();
        $stmt = $db->prepare("DELETE FROM contactos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
