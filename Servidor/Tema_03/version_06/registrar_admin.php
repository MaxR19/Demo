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
require_once './clases/Usuarios.php';
require_once './clases/Roles.php';


// Recoger y limpiar datos del formulario
$usuario  = trim($_POST['usuario'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');
$nombre = trim($_POST['nombre'] ?? '');
$apellidos = trim($_POST['apellidos'] ?? '');
$idRol    = $_POST['idRol'] ?? '';

// Validar que ninguno de los campos a rellenar esté vacío
if ($usuario === '' || $email === '' || $password === '' || $nombre === '' || $apellidos === '' || !is_numeric($idRol)) {
    redirigirConMensaje('admin.php', 'Todos los campos son obligatorios.');
}

// Validar el nombre de usuario
if (!validarUsuario($usuario)) {
    redirigirConMensaje('admin.php', 'El nombre de usuario no es válido.');
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
$rol = new Rol();
$rolExistente = $rol->obtenerPorId((int)$idRol);

if (!$rolExistente) {
    redirigirConMensaje('admin.php', 'El rol seleccionado no existe.');
}

// Insertar el nuevo usuario
$newUser = new Usuario();
$exito = $newUser->insertar($usuario, $email, $password, $nombre, $apellidos, (int)$idRol);

if ($exito) {
    $_SESSION['mensaje'] = "Usuario creado correctamente.";
} else {
    $_SESSION['mensaje'] = "Error: no se pudo crear el usuario. ¿Ya existe?";
}

header("Location: admin.php");
exit;