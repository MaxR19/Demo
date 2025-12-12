<?php

/*
Objetivo del archivo Roles.php
Este archivo define la clase Rol, encargada de gestionar las operaciones relacionadas 
con la tabla roles:
Obtener un rol por ID.
Listar todos los roles.
Insertar un nuevo rol.
Eliminar un rol.
*/

require_once 'init.php';

class Rol {

    /**
     * Obtiene todos los roles existentes.
     * @return array
     */
    public function obtenerTodos(): array {
        $db = conectarDB();
        $stmt = $db->query("SELECT * FROM roles ORDER BY idRol ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene un rol por su ID.
     * @param int $idRol
     * @return array|null
     */
    public function obtenerPorId(int $idRol): ?array {
        $db = conectarDB();
        $stmt = $db->prepare("SELECT * FROM roles WHERE idRol = ?");
        $stmt->execute([$idRol]);
        $rol = $stmt->fetch(PDO::FETCH_ASSOC);

        return $rol ?: null;
    }

    public function obtenerPorDescripcion(string $descripcion): ?array {
        $db = conectarDB();
        $stmt = $db->prepare("SELECT * FROM roles WHERE descripcion = ? LIMIT 1");
        $stmt->execute([$descripcion]);
        $rol = $stmt->fetch(PDO::FETCH_ASSOC);

        return $rol ?: null;
    }

    /**
     * Inserta un nuevo rol (e.g. "admin", "usuario").
     * @param string $descripcion
     * @return bool
     */
    public function insertar(string $descripcion): bool {
        try {
            $db = conectarDB();
            $stmt = $db->prepare("INSERT INTO roles (descripcion) VALUES (?)");
            return $stmt->execute([$descripcion]);
        } catch (PDOException $e) {
            // Evita fallo por duplicado u otro error
            return false;
        }
    }

    /**
     * Elimina un rol por ID.
     * No se recomienda eliminar roles que están en uso.
     * @param int $idRol
     * @return bool
     */
    public function eliminar(int $idRol): bool {
        try {
            $db = conectarDB();
            $stmt = $db->prepare("DELETE FROM roles WHERE idRol = ?");
            return $stmt->execute([$idRol]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
