<?php

/*
Objetivo de session_check.php
Este archivo es un middleware (intermediario) que se incluye al principio de todas las 
páginas protegidas. Su función es:
Verificar si el usuario está autenticado.
Controlar el cierre de sesión por inactividad.
Ofrecer funciones auxiliares como esAdmin() para controlar permisos de forma centralizada.
*/

// Centraliza sesión, manejo de errores y helpers
require_once 'init.php';

// Establecer el tiempo máximo de inactividad (en segundos)
$limiteInactividad = 300; // 5 minutos

// 1. Verificar si hay una sesión activa
if (!estaLogueado()) {
    $_SESSION['mensaje'] = "Debes iniciar sesión primero.";
    header("Location: login.php");
    exit;
}

// 2. Verificar si ha pasado el tiempo de inactividad
if (isset($_SESSION['ultimo_acceso'])) {
    $tiempoInactivo = time() - $_SESSION['ultimo_acceso'];
    if ($tiempoInactivo > $limiteInactividad) {
        session_unset();
        session_destroy();

        // Reiniciar sesión para poder mostrar mensaje
        session_start();
        $_SESSION['mensaje'] = "Sesión cerrada por inactividad.";
        header("Location: login.php");
        exit;
    }
}

// 3. Actualizar el tiempo del último acceso
$_SESSION['ultimo_acceso'] = time();