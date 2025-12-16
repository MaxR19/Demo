<?php

/*
Objetivos de este archivo:
- Verificar si el usuario está autenticado.
- Controlar el cierre de sesión por inactividad.
- Actualizar el tiempo del último acceso.
*/

// Centraliza sesión, manejo de errores y helpers
require_once 'init.php';

// Establecer el tiempo máximo de inactividad (5 minutos)
$limiteInactividad = 300;

// 1. Verificar si hay una sesión activa
if (!estaLogueado()) {
    cambiardePagina('login.php', 'Debes iniciar sesión para continuar.');
}

// 2. Verificar si ha pasado el tiempo de inactividad
if (isset($_SESSION['login_time'])) {
    if ((time() - $_SESSION['login_time']) > $limiteInactividad) {
        // Borrar todos los datos de la sesión
        session_unset();
        // Destruir la sesión
        session_destroy();

        // Reiniciar sesión para poder mostrar mensaje
        session_start();
        cambiardePagina('login.php', 'Sesión cerrada por inactividad.');
    }
}

// 3. Actualizar el tiempo del último acceso
$_SESSION['login_time'] = time();