<?php

/*
Este archivo define la clase Rol, encargada de gestionar las operaciones relacionadas 
con la tabla roles:
Obtener un rol por ID.
Listar todos los roles.
Insertar un nuevo rol.
Eliminar un rol.
*/

class Rol {

    // Obtiene todos los roles existentes.
    public function obtenerRoles(): array {
        $db = conectarDB();
        $stmt = $db->query("SELECT * FROM roles ORDER BY idRol ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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