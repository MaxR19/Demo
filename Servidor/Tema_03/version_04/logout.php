<?php

/*
Objetivo de logout.php
Este archivo cierra la sesión del usuario de forma segura. Es decir:
Elimina las variables de sesión.
Destruye la sesión.
Elimina la cookie de “recordar usuario” si existe.
Redirige al usuario a la página de login o inicio.
*/

require_once 'init.php';

// Eliminar todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Eliminar cookie de "recordar usuario" si existe
if (isset($_COOKIE['recordar_usuario'])) {
    setcookie('recordar_usuario', '', time() - 3600, '/');
}

// Redirigir al login con mensaje
session_start(); // Reiniciar sesión para mostrar mensaje en login
$_SESSION['mensaje'] = "Sesión cerrada correctamente.";
header("Location: login.php");
exit;
