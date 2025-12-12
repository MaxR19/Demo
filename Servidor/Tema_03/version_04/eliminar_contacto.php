<?php
require_once 'init.php';
require_once 'session_check.php';
require_once 'Contactos.php';

// Si quieres que SOLO admin pueda hacerlo, descomenta:
// if (!esAdmin()) redirigirConMensaje('dashboard.php', 'Acceso restringido a administradores.');

$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    redirigirConMensaje('contactos.php', 'ID de contacto no válido.');
}

$model = new Contacto();
$datos = $model->obtenerPorId((int)$id);

if (!$datos) {
    redirigirConMensaje('contactos.php', 'El contacto no existe.');
}

$model->eliminar((int)$id);

redirigirConMensaje('contactos_cliente.php?idCliente='.(int)$datos['idCliente'], 'Contacto eliminado correctamente.');
