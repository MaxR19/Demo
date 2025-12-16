<?php

class Contacto {

    public $contacto_id;
    public $nombre;
    public $apellidos;
    public $email;
    public $numTelefono;
    public $cliente_id;

        public function __construct($data = []) {
        
        if (!empty($data)) {
            $this->contacto_id = $data['id'] ?? null;
            $this->nombre     = $data['nombre'] ?? null;
            $this->apellidos  = $data['apellidos'] ?? null;
            $this->email      = $data['email'] ?? null;
            $this->numTelefono = $data['numTelefono'] ?? null;
            $this->cliente_id     = $data['idCliente'] ?? null;
        }
    }

    // ====== Getters y Setters ======
    public function getId(): int {
        return $this->contacto_id ?? 0;
    }

    public function setId(int $id): void {
        $this->contacto_id = $id;
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

    public function getEmail(): string {
        return $this->email ?? '';
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getNumTelefono(): string {
        return $this->numTelefono ?? '';
    }

    public function setNumTelefono(string $numTelefono): void {
        $this->numTelefono = $numTelefono;
    }

    public function getClienteId(): int {
        return $this->cliente_id ?? 0;
    }

    public function setClienteId(int $cliente_id): void {
        $this->cliente_id = $cliente_id;
    }

    // ====== Métodos CRUD ======

        // CREATE

    // Insertar un nuevo cliente
    public function insertar(string $nombre, string $apellidos, string $email, string $numTelefono, int $cliente_id): bool {
        try {
            $db = conectarDB();
            $stmt = $db->prepare("
                INSERT INTO contactos (nombre, apellidos, email, numTelefono, cliente_id)
                VALUES (:nombre, :apellidos, :email, :numTelefono, :cliente_id)
            ");

            return $stmt->execute([
                ':nombre' => $nombre,
                ':apellidos' => $apellidos,
                ':email' => $email,
                ':numTelefono' => $numTelefono,
                ':cliente_id' => $cliente_id
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    // READ

    // Obtener todos los contactos
    public function obtenerContactos(): array {
        $db = conectarDB();
        $stmt = $db->query("SELECT * FROM contactos ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener todos los contactos de un cliente
    public function obtenerContactosPorCliente(int $idCliente): array {
        $db = conectarDB();
        $stmt = $db->query("
            SELECT * 
            FROM contactos
            WHERE idCliente = :idCliente 
            ORDER BY idCliente ASC
        ");

        $stmt->execute([':idCliente' => $idCliente]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
