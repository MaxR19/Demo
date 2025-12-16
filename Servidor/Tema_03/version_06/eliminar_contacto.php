<?php
require_once 'init.php';
require_once 'validacion_usuario.php';
require_once './clases/Contactos.php';

if (!esAdmin()) redirigirConMensaje('dashboard.php', 'Acceso restringido a administradores.');

$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) redirigirConMensaje('gestion_contactos.php', 'ID no válido.');

$model = new Contacto();
$model->eliminar((int)$id);

redirigirConMensaje('gestion_contactos.php', 'Contacto eliminado correctamente.');