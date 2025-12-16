<?php
require_once 'validacion_usuario.php';

$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) redirigirConMensaje('gestion_clientes.php', 'ID no válido.');

$model = new Cliente();
$model->eliminar((int)$id);

redirigirConMensaje('gestion_clientes.php', 'Cliente eliminado correctamente.');