<?php
require_once 'init.php';

class Contacto {

    public function obtenerTodos(): array {
        $db = conectarDB();
        $stmt = $db->query("
            SELECT c.*, cl.nombre AS cliente_nombre, cl.apellidos AS cliente_apellidos
            FROM contactos c
            INNER JOIN clientes cl ON cl.id = c.idCliente
            ORDER BY c.id DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorCliente(int $idCliente): array {
        $db = conectarDB();
        $stmt = $db->prepare("SELECT * FROM contactos WHERE idCliente = ? ORDER BY id DESC");
        $stmt->execute([$idCliente]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId(int $id): ?array {
        $db = conectarDB();
        $stmt = $db->prepare("SELECT * FROM contactos WHERE id = ?");
        $stmt->execute([$id]);
        $c = $stmt->fetch(PDO::FETCH_ASSOC);
        return $c ?: null;
    }

    public function insertar(int $idCliente, string $nombre, string $apellidos, string $email, string $telefono): bool {
        try {
            $db = conectarDB();
            $stmt = $db->prepare("
                INSERT INTO contactos (idCliente, nombre, apellidos, email, telefono)
                VALUES (?, ?, ?, ?, ?)
            ");
            return $stmt->execute([$idCliente, $nombre, $apellidos, $email, $telefono]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function actualizar(int $id, int $idCliente, string $nombre, string $apellidos, string $email, string $telefono): bool {
        try {
            $db = conectarDB();
            $stmt = $db->prepare("
                UPDATE contactos
                SET idCliente = ?, nombre = ?, apellidos = ?, email = ?, telefono = ?
                WHERE id = ?
            ");
            return $stmt->execute([$idCliente, $nombre, $apellidos, $email, $telefono, $id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function eliminar(int $id): bool {
        $db = conectarDB();
        $stmt = $db->prepare("DELETE FROM contactos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
