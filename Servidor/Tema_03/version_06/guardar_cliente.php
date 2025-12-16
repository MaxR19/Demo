<?php
require_once 'validacion_usuario.php';

$id        = isset($_POST['id']) && is_numeric($_POST['id']) ? (int)$_POST['id'] : null;
$nombre    = trim($_POST['nombre'] ?? '');
$apellidos = trim($_POST['apellidos'] ?? '');
$edad      = $_POST['edad'] ?? '';
$email     = trim($_POST['email'] ?? '');
$documento = trim($_POST['documento'] ?? '');

if ($nombre === '' || $apellidos === '' || $edad === '' || $email === '' || $documento === '') {
    cambiardePagina($id ? "formulario_clientes.php?id=$id" : "formulario_clientes.php", "Debes completar todos los campos.");
}

if(!validarNombre($nombre)) {
    cambiardePagina($id ? "formulario_clientes.php?id=$id" : "formulario_clientes.php", "Nombre no válido.");
}

if(!validarApellidos($apellidos)) {
    cambiardePagina($id ? "formulario_clientes.php?id=$id" : "formulario_clientes.php", "Apellidos no válidos.");
}

if (!validarEdad($edad)) {
    cambiardePagina($id ? "formulario_clientes.php?id=$id" : "formulario_clientes.php", "Edad no válida (0-120).");
}

if (!validarEmail($email)) {
    cambiardePagina($id ? "formulario_clientes.php?id=$id" : "formulario_clientes.php", "Email no válido.");
}

if (!validarDocumento($documento)) {
    cambiardePagina($id ? "formulario_clientes.php?id=$id" : "formulario_clientes.php", "Documento no válido.");
}

$cliente = new Cliente();
$ok = $id
    ? $cliente->actualizar($id, $nombre, $apellidos, (int)$edad, $email, $documento)
    : $cliente->insertar($nombre, $apellidos, (int)$edad, $email, $documento);

cambiardePagina(
    'gestion_clientes.php', 
    $ok ? "Cliente guardado correctamente." : "Error al guardar el cliente."
);