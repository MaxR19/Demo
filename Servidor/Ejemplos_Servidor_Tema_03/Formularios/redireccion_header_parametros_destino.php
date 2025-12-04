<?php

// Recuperamos los parámetros GET
$nombre = isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : 'Desconocido';
$edad = isset($_GET['edad']) ? (int)$_GET['edad'] : 0;

echo "Hola, $nombre. Tienes $edad años.";

?>
