<?php
require_once 'init.php';
require_once 'session_check.php';
require_once 'Clientes.php';

if (!esAdmin()) redirigirConMensaje('dashboard.php', 'Acceso restringido a administradores.');

$id        = isset($_POST['id']) && is_numeric($_POST['id']) ? (int)$_POST['id'] : null;
$nombre    = trim($_POST['nombre'] ?? '');
$apellidos = trim($_POST['apellidos'] ?? '');
$edad      = $_POST['edad'] ?? '';
$email     = trim($_POST['email'] ?? '');
$documento = trim($_POST['documento'] ?? '');

if ($nombre === '' || $apellidos === '' || $edad === '' || $email === '' || $documento === '') {
    $_SESSION['mensaje'] = "Debes completar todos los campos.";
    header("Location: " . ($id ? "formulario_clientes.php?id=$id" : "formulario_clientes.php"));
    exit;
}

if (!validarEdad($edad)) {
    $_SESSION['mensaje'] = "Edad no válida (0-120).";
    header("Location: " . ($id ? "formulario_clientes.php?id=$id" : "formulario_clientes.php"));
    exit;
}

if (!validarEmail($email)) {
    $_SESSION['mensaje'] = "Email no válido.";
    header("Location: " . ($id ? "formulario_clientes.php?id=$id" : "formulario_clientes.php"));
    exit;
}

if (!validarDocumento($documento)) {
    $_SESSION['mensaje'] = "Documento no válido (formato).";
    header("Location: " . ($id ? "formulario_clientes.php?id=$id" : "formulario_clientes.php"));
    exit;
}

$model = new Cliente();
$ok = $id
    ? $model->actualizar($id, $nombre, $apellidos, (int)$edad, $email, $documento)
    : $model->insertar($nombre, $apellidos, (int)$edad, $email, $documento);

$_SESSION['mensaje'] = $ok ? "Cliente guardado correctamente." : "No se pudo guardar (¿email/documento duplicado?).";
header("Location: gestion_clientes.php");
exit;
