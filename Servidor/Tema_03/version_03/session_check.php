<?php
session_start();

// Inactividad máxima en segundos (5 minutos)
$inactividad_max = 300;

if (!isset($_SESSION['usuario'])) {
    $_SESSION['mensaje'] = "Debes iniciar sesión.";
    header("Location: login.php");
    exit;
}

// Controlar inactividad
if (isset($_SESSION['ultimo_acceso'])) {
    $tiempo_transcurrido = time() - $_SESSION['ultimo_acceso'];
    if ($tiempo_transcurrido > $inactividad_max) {
        session_unset();
        session_destroy();
        $_SESSION['mensaje'] = "Sesión cerrada por inactividad.";
        header("Location: login.php");
        exit;
    }
}

// Actualizar tiempo de último acceso
$_SESSION['ultimo_acceso'] = time();
