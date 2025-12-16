<?php
require_once 'init.php';
require_once 'validacion_usuario.php';
require_once './clases/Clientes.php';

if (!esAdmin()) redirigirConMensaje('dashboard.php', 'Acceso restringido a administradores.');

$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) redirigirConMensaje('gestion_clientes.php', 'ID no válido.');

$model = new Cliente();
$model->eliminar((int)$id);

redirigirConMensaje('gestion_clientes.php', 'Cliente eliminado correctamente.');