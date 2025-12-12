<?php

/*
Este archivo se encarga de eliminar usuarios desde el panel de administración.
Objetivo
Este script debe:
Comprobar que hay sesión iniciada.
Verificar que el usuario es administrador.
Validar que el id del usuario a eliminar es válido.
Prevenir que un administrador se elimine a sí mismo.
Ejecutar la eliminación si todo es correcto.
Redirigir con un mensaje de éxito o error.
*/

// Carga todo lo necesario: sesión, errores, helpers
require_once 'init.php';
require_once 'Usuarios.php';

// Solo los administradores pueden eliminar usuarios
if (!esAdmin()) {
    redirigirConMensaje('dashboard.php', 'No tienes permisos para eliminar usuarios.');
}

// Validar que el ID recibido por GET sea válido
$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    redirigirConMensaje('admin.php', 'ID de usuario no válido.');
}

// Obtener el usuario a eliminar
$usuarioModel = new Usuario();
$usuarioAEliminar = $usuarioModel->obtenerPorId((int)$id);

if (!$usuarioAEliminar) {
    redirigirConMensaje('admin.php', 'El usuario no existe.');
}

// Prevenir que el admin se elimine a sí mismo
if ($_SESSION['usuario'] === $usuarioAEliminar['usuario']) {
    redirigirConMensaje('admin.php', 'No puedes eliminar tu propia cuenta.');
}

// Ejecutar la eliminación
$usuarioModel->eliminar((int)$id);
redirigirConMensaje('admin.php', 'Usuario eliminado correctamente.');