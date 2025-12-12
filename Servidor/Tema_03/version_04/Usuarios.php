<?php

/*
Objetivo del archivo Usuarios.php
Este archivo define la clase Usuario, que se encarga de gestionar todas las operaciones 
relacionadas con los usuarios:
Insertar nuevos usuarios (con contraseña hasheada).
Obtener usuarios por ID o por nombre.
Obtener lista completa (para admins).
Eliminar usuarios por ID.
*/

require_once 'init.php';

class Usuario {

    /**
     * Inserta un nuevo usuario en la base de datos.
     * @param string $usuario
     * @param string $password
     * @param int $idRol
     * @return bool True si se insertó correctamente, False si hubo error (e.g. duplicado)
     */
    
    public function insertar(string $usuario, string $email, string $password, int $idRol): bool {
        try {
            $db = conectarDB();
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $db->prepare("
                INSERT INTO usuarios (usuario, email, password, idRol)
                VALUES (?, ?, ?, ?)
            ");
            return $stmt->execute([$usuario, $email, $hash, $idRol]);

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Obtiene los datos de un usuario a partir del nombre de usuario.
     * @param string $usuario
     * @return array|null
     */
    public function obtenerPorUsuario(string $usuario): ?array {
        $db = conectarDB();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        return $usuario ?: null;
    }

    /**
     * Obtiene los datos de un usuario a partir de su ID.
     * @param int $id
     * @return array|null
     */
    public function obtenerPorId(int $id): ?array {
        $db = conectarDB();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        return $usuario ?: null;
    }

    /**
     * Obtiene los datos de un usuario a partir de su ID.
     * @param string $email
     * @return array|null
     */
    public function obtenerPorEmail(string $email): ?array {
    $db = conectarDB();
    $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    return $usuario ?: null;
}

    /**
     * Devuelve una lista de todos los usuarios con su rol.
     * Solo debe usarse por administradores.
     * @return array
     */
    public function obtenerTodos(): array {
        $db = conectarDB();
        $stmt = $db->query("
            SELECT u.id, u.usuario, r.descripcion AS rol
            FROM usuarios u
            INNER JOIN roles r ON u.idRol = r.idRol
            ORDER BY u.id ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Elimina un usuario por ID.
     * @param int $id
     * @return bool
     */
    public function eliminar(int $id): bool {
        $db = conectarDB();
        $stmt = $db->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function actualizarNombre($usuario_actual, $nuevo_usuario) {
        $db = conectarDB();

        // Verificar si ya existe ese nombre
        $existe = $db->prepare("SELECT COUNT(*) FROM usuarios WHERE usuario = ? AND usuario != ?");
        $existe->execute([$nuevo_usuario, $usuario_actual]);

        if ($existe->fetchColumn() > 0) {
            return false; // Nombre ya en uso
        }

        $stmt = $db->prepare("UPDATE usuarios SET usuario = ? WHERE usuario = ?");
        return $stmt->execute([$nuevo_usuario, $usuario_actual]);
    }

    public function actualizarEmail(int $idUsuario, string $nuevoEmail): bool {
        $db = conectarDB();

        // Verificar si ya existe ese email en otro usuario
        $existe = $db->prepare("SELECT COUNT(*) FROM usuarios WHERE email = ? AND id != ?");
        $existe->execute([$nuevoEmail, $idUsuario]);

        if ($existe->fetchColumn() > 0) {
            return false; // Email ya en uso
        }

        $stmt = $db->prepare("UPDATE usuarios SET email = ? WHERE id = ?");
        return $stmt->execute([$nuevoEmail, $idUsuario]);
    }

    
    public function actualizarPassword($idUsuario, $nuevaPassword) {
        $db = conectarDB();
        $hash = password_hash($nuevaPassword, PASSWORD_DEFAULT);

        $stmt = $db->prepare("UPDATE usuarios SET password = ? WHERE id = ?");
        return $stmt->execute([$hash, $idUsuario]);
    }

}
