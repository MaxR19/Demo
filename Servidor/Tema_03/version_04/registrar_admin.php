<?php

/*
Este script permite que un usuario administrador cree nuevos usuarios, ya sea con rol 
"admin" o "usuario".

Objetivo
Este archivo debe:
Verificar que la sesión está activa.
Confirmar que el usuario actual es administrador.
Validar los datos del formulario.
Crear un nuevo usuario con el rol seleccionado.
Redirigir con un mensaje de éxito o error.
*/

require_once 'init.php';
require_once 'Usuarios.php';
require_once 'Roles.php';

// Solo un administrador puede acceder
if (!esAdmin()) {
    redirigirConMensaje('dashboard.php', 'Acceso no permitido.');
}

// Recoger y limpiar datos del formulario
$usuario  = trim($_POST['usuario'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$idRol    = $_POST['idRol'] ?? '';

// Validar que todos los campos estén completos y correctos
if ($usuario === '' || $email === '' || $password === '' || !is_numeric($idRol)) {
    redirigirConMensaje('admin.php', 'Todos los campos son obligatorios y válidos.');
}

// Validar el nombre de usuario
if (!validarUsuario($usuario)) {
    redirigirConMensaje('admin.php', 'El nombre de usuario solo puede contener letras, números y guiones bajos (3-20 caracteres).');
}

// Validar contraseña
if (!validarPassword($password)) {
    redirigirConMensaje('admin.php', 'La contraseña debe tener al menos 6 caracteres.');
}

// Validar email
if (!validarEmail($email)) {
    redirigirConMensaje('admin.php', 'Email no válido.');
}

// Verificar que el rol existe
$rolModel = new Rol();
$rolExistente = $rolModel->obtenerPorId((int)$idRol);

if (!$rolExistente) {
    redirigirConMensaje('admin.php', 'El rol seleccionado no existe.');
}

// Insertar el nuevo usuario
$usuarioModel = new Usuario();
$exito = $usuarioModel->insertar($usuario, $email, $password, (int)$idRol);

if ($exito) {
    $_SESSION['mensaje'] = "Usuario creado correctamente.";
} else {
    $_SESSION['mensaje'] = "Error: no se pudo crear el usuario. ¿Ya existe?";
}

header("Location: admin.php");
exit;