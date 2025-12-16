<?php

/*
Objetivo de registrar_action.php
Este archivo se encarga de registrar a un nuevo usuario con rol "usuario" (no 
administrador) desde la vista pública (registro.php), es decir, desde el formulario de 
registro que no requiere estar logueado.

Consideraciones importantes
No requiere sesión activa.
Asigna automáticamente el rol "usuario" a quien se registre.
Valida los campos del formulario.
Evita duplicados.
Hash de contraseña usando password_hash().
*/

require_once 'init.php';
require_once './clases/Usuarios.php';
require_once './clases/Roles.php';

// Recoger y limpiar datos del formulario
$usuario  = trim($_POST['usuario'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Validación de campos vacíos
if ($usuario === '' || $email === '' || $password === '') {
    $_SESSION['mensaje'] = "Debes completar todos los campos.";
    header("Location: registro.php");
    exit;
}

// Validar nombre de usuario (con helpers.php)
if (!validarUsuario($usuario)) {
    $_SESSION['mensaje'] = "El nombre de usuario solo puede contener letras, números y guiones bajos (3-20 caracteres).";
    header("Location: registro.php");
    exit;
}

// Validar contraseña
if (!validarPassword($password)) {
    $_SESSION['mensaje'] = "La contraseña debe tener al menos 6 caracteres.";
    header("Location: registro.php");
    exit;
}

// Validar email
if (!validarEmail($email)) {
    $_SESSION['mensaje'] = "Email no válido.";
    header("Location: registro.php");
    exit;
}


// Insertar usuario
$usu = new Usuario();
$exito = $usu->insertar($usuario, $email , $password, $rolUsuario['idRol']);

// Redirigir según resultado
if ($exito) {
    $_SESSION['mensaje'] = "Usuario registrado correctamente. Ahora puedes iniciar sesión.";
    header("Location: login.php");
} else {
    $_SESSION['mensaje'] = "Error: el nombre de usuario ya existe o no se pudo registrar.";
    header("Location: registro.php");
}
exit;