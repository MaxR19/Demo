<?php
require_once 'init.php';
require_once 'session_check.php';
require_once 'Contactos.php';
require_once 'Clientes.php';

// Si quieres que SOLO admin pueda hacerlo, descomenta:
// if (!esAdmin()) redirigirConMensaje('dashboard.php', 'Acceso restringido a administradores.');

$id        = isset($_POST['id']) && is_numeric($_POST['id']) ? (int)$_POST['id'] : null;
$idCliente = $_POST['idCliente'] ?? null;

$nombre    = trim($_POST['nombre'] ?? '');
$apellidos = trim($_POST['apellidos'] ?? '');
$email     = trim($_POST['email'] ?? '');
$telefono  = trim($_POST['telefono'] ?? '');

if (!$idCliente || !is_numeric($idCliente)) {
    $_SESSION['mensaje'] = "Debes seleccionar un cliente.";
    header("Location: " . ($id ? "formulario_contacto.php?id=$id" : "formulario_contacto.php"));
    exit;
}
$idCliente = (int)$idCliente;

if ($nombre === '' || $apellidos === '' || $email === '' || $telefono === '') {
    $_SESSION['mensaje'] = "Debes completar todos los campos.";
    header("Location: " . ($id ? "formulario_contacto.php?id=$id" : "formulario_contacto.php?idCliente=$idCliente"));
    exit;
}

if (!validarEmail($email)) {
    $_SESSION['mensaje'] = "Email no válido.";
    header("Location: " . ($id ? "formulario_contacto.php?id=$id" : "formulario_contacto.php?idCliente=$idCliente"));
    exit;
}

$telefonoNorm = normalizarTelefonoES($telefono);
if (!validarTelefonoES($telefonoNorm)) {
    $_SESSION['mensaje'] = "Teléfono no válido. Debe ser un número español (9 dígitos) y puede incluir +34.";
    header("Location: " . ($id ? "formulario_contacto.php?id=$id" : "formulario_contacto.php?idCliente=$idCliente"));
    exit;
}

// Opcional: verificar que el cliente exista
$clienteModel = new Cliente();
$cliente = $clienteModel->obtenerPorId($idCliente);
if (!$cliente) {
    $_SESSION['mensaje'] = "El cliente seleccionado no existe.";
    header("Location: formulario_contacto.php");
    exit;
}

$model = new Contacto();
$ok = $id
    ? $model->actualizar($id, $idCliente, $nombre, $apellidos, $email, $telefonoNorm)
    : $model->insertar($idCliente, $nombre, $apellidos, $email, $telefonoNorm);

$_SESSION['mensaje'] = $ok ? "Contacto guardado correctamente." : "No se pudo guardar el contacto.";

header("Location: contactos_cliente.php?idCliente=" . $idCliente);
exit;
