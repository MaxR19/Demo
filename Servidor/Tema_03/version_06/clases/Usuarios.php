<?php

class Usuario {

    public $usuario_id;
    public $usuario;
    public $email;
    public $password;
    public $nombre;
    public $apellidos;
    public $rol_id;

    // ====== Constructor ======

    public function __construct($data = []) {
        
        if (!empty($data)) {
            $this->usuario_id = $data['id'] ?? null;
            $this->usuario    = $data['usuario'] ?? null;
            $this->password   = $data['password'] ?? null;
            $this->email      = $data['email'] ?? null;
            $this->nombre     = $data['nombre'] ?? null;
            $this->apellidos  = $data['apellidos'] ?? null;
            $this->rol_id     = $data['idRol'] ?? null;
        }
    }

    // ====== Getters y Setters ======

    public function getId() {
        return $this->usuario_id ?? 0;
    }

    public function setId($id) {
        $this->usuario_id = $id;
    }

    public function getUsuario() {
        return $this->usuario ?? '';
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getPassword() {
        return $this->password ?? '';
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getEmail() {
        return $this->email ?? '';
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getNombre() {
        return $this->nombre ?? '';
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getApellidos() {
        return $this->apellidos ?? '';
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function getRolId() {
        return $this->rol_id ?? 0;
    }

    public function setRolId($rol_id) {
        $this->rol_id = $rol_id;
    }

    // ====== Métodos CRUD ======

    // CREATE

    /**
     * Inserta un nuevo usuario en la base de datos.
     * @param string $usuario
     * @param string $password
     * @param int $idRol
     * @return bool True si se insertó correctamente, False si hubo error (e.g. duplicado)
    */

    public function insertar(string $usuario, string $password, string $email, string $nombre, string $apellidos, int $idRol): bool {
        try {
            $db = conectarDB();
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $db->prepare("
                INSERT INTO usuarios (usuario, password, email, nombre, apellidos, idRol) 
                VALUES (:usuario, :password, :email, :nombre, :apellidos, :rol_id)"
            );

            return $stmt->execute([
                ':usuario'   => $usuario,
                ':password'  => $hash,
                ':email'     => $email,
                ':nombre'    => $nombre,
                ':apellidos' => $apellidos,
                ':rol_id'    => $idRol,
            ]);

        } catch (PDOException $e) {
            return false;
        }
    }

    // READ

    // Obtener los datos de un usuario a partir de un campo específico
    public function obtenerUsuarioPorCampo(string $campo, int|string $valor): ?Usuario {
        try {
            $db = conectarDB();

            $colsStmt = $db->query("PRAGMA table_info(usuarios)");
            $campos = [];

            while ($col = $colsStmt->fetch(PDO::FETCH_ASSOC)) {
                $campos[] = $col['name'];  // 'name' es el nombre de la columna
            }

            if (!in_array($campo, $campos, true)) {
                return null;
            }

            $stmt = $db->prepare("SELECT * FROM usuarios WHERE $campo = :valor");
            $stmt->execute([
                ':valor' => $valor
            ]);

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // 4. Si no hay resultado, devolvemos null
            if ($usuario === false) {
            return null;
            }

            return new Usuario($usuario);

        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Devuelve una lista de todos los usuarios con su rol.
     * @return array
     */
    public function obtenerUsuarios(): array {
        try {
            $db = conectarDB();
            $stmt = $db->query("
                SELECT 
                    U.id, 
                    U.usuario,
                    U.email,
                    U.nombre,
                    U.apellidos,
                    R.descripcion AS rol
                FROM usuarios AS U
                INNER JOIN roles AS R 
                ON U.idRol = R.idRol
                ORDER BY u.id ASC
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    // UPDATE
    public function actualizar(int $id, string $usuario, string $password, string $email, string $nombre, string $apellidos, int $idRol): bool {
        try {
            $db = conectarDB();
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $db->prepare("
                UPDATE usuarios 
                SET usuario = :usuario, password = :password, email = :email, nombre = :nombre, apellidos = :apellidos, idRol = :rol_id 
                WHERE id = :id
            ");

            return $stmt->execute([
                ':usuario'   => $usuario,
                ':password'  => $hash,
                ':email'     => $email,
                ':nombre'    => $nombre,
                ':apellidos' => $apellidos,
                ':rol_id'    => $idRol,
                ':id'        => $id
            ]);

        } catch (PDOException $e) {
            return false;
        }
    }

    // DELETE
    public function eliminar(int $id): bool {
        try {
            $db = conectarDB();
            $stmt = $db->prepare("
                DELETE FROM usuarios WHERE id = :id
            ");

            return $stmt->execute([
                ':id' => $id
            ]);

        } catch (PDOException $e) {
            return false;
        }
    }
}