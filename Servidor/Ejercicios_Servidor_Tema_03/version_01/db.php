<?php
require_once "utils.php";

class BaseDatos
{
    protected $pdo;

    public function __construct()
    {
        global $config;

        $bbdd = $config['database']['dbname'];
        $path = __DIR__ . '/bbdd/' . $bbdd;

        if (!file_exists($path)) {
            die("❌ Error: La base de datos no se encuentra en $path");
        }

        $this->pdo = new PDO('sqlite:' . $path);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "✅ Conexión exitosa a: $path";
    }

    public function getPdo()
    {
        return $this->pdo;
    }
}
