<?php

class Cliente {

    public $cliente_id;
    public $nombre;
    public $apellidos;
    public $edad;
    public $email;
    public $documento;

        public function __construct($data = []) {
        
        if (!empty($data)) {
            $this->cliente_id = $data['id'] ?? null;
            $this->nombre     = $data['nombre'] ?? null;
            $this->apellidos  = $data['apellidos'] ?? null;
            $this->edad       = $data['edad'] ?? null;
            $this->email      = $data['email'] ?? null;
            $this->documento  = $data['documento'] ?? null;
            $this->rol_id     = $data['idRol'] ?? null;
        }
    }

    // ====== Getters y Setters ======
    public function getId(): int {
        return $this->cliente_id ?? 0;
    }

    public function setId(int $id): void {
        $this->cliente_id = $id;
    }

    public function getNombre(): string {
        return $this->nombre ?? '';
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function getApellidos(): string {
        return $this->apellidos ?? '';
    }

    public function setApellidos(string $apellidos): void {
        $this->apellidos = $apellidos;
    }

    public function getEdad(): int {
        return $this->edad ?? 0;
    }

    public function setEdad(int $edad): void {
        $this->edad = $edad;
    }

    public function getEmail(): string {
        return $this->email ?? '';
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getDocumento(): string {
        return $this->documento ?? '';
    }

    public function setDocumento(string $documento): void {
        $this->documento = $documento;
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
                VALUES (:nombre, :apellidos, :edad, :email, :documento)
            ");

            return $stmt->execute([
                ':nombre' => $nombre,
                ':apellidos' => $apellidos,
                ':edad' => $edad,
                ':email' => $email,
                ':documento' => strtoupper($documento)
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    // READ

    // Obtener los datos de un cliente a partir de un campo específico
    public function obtenerClientePorCampo(string $campo, int|string $valor): ?Cliente {
        try {
            $db = conectarDB();

            $colsStmt = $db->query("PRAGMA table_info(clientes)");
            $campos = [];

            while ($col = $colsStmt->fetch(PDO::FETCH_ASSOC)) {
                $campos[] = $col['name'];  // 'name' es el nombre de la columna
            }

            if (!in_array($campo, $campos, true)) {
                return null;
            }

            $stmt = $db->prepare("SELECT * FROM clientes WHERE $campo = :valor");
            $stmt->execute([
                ':valor' => $valor
            ]);

            $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

            return new Cliente($cliente) ?: null;

        } catch (PDOException $e) {
            return null;
        }
    }

    // Devuelve una lista de todos los clientes
    public function obtenerClientes(): array {
        $db = conectarDB();
        $stmt = $db->query("SELECT * FROM clientes ORDER BY id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function actualizar(int $id, string $nombre, string $apellidos, int $edad, string $email, string $documento): bool {
        try {
            $db = conectarDB();
            $stmt = $db->prepare("
                UPDATE clientes
                SET nombre = :nombre, apellidos = :apellidos, edad = :edad, email = :email, documento = :documento
                WHERE id = :id
            ");

            return $stmt->execute([
                ':nombre' => $nombre,
                ':apellidos' => $apellidos,
                ':edad' => $edad,
                ':email' => $email,
                ':documento' => strtoupper($documento),
                ':id' => $id
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
                DELETE FROM clientes WHERE id = :id
            ");

            return $stmt->execute([
                ':id' => $id
            ]);

        } catch (PDOException $e) {
            return false;
        }
    }
}
