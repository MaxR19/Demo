<?php

// Este archivo establece la configuración inicial de la aplicación

// Inicia sesión si no hay ya un usuario con una sesión activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Carga los manejadores de errores personalizados
require_once 'error.php';

// Incluye los funciones auxiliares y validaciones
require_once 'utils.php';

// Incluye la conexión a la base de datos
require_once 'bbdd.php';