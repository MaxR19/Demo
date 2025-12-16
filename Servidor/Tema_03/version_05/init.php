<?php

// 1. Iniciar sesión si no está iniciada aún
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Cargar manejadores de errores personalizados
require_once 'error.php';

// 3. Incluir funciones auxiliares y validaciones
require_once 'utils.php';

// 4. Incluir conexión a base de datos
require_once 'bbdd.php';