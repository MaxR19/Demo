<?php

/*
Este archivo es útil para:
Evitar duplicar código (como comprobaciones de roles).
Hacer más legibles y mantenibles los archivos como admin.php, eliminar_user.php, etc.
Facilitar pruebas y refactorizaciones futuras.
*/

/**
 * Verifica si el usuario ha iniciado sesión.
 */
function estaLogueado(): bool {
    return isset($_SESSION['usuario']) && !empty($_SESSION['usuario']);
}

/**
 * Verifica si el usuario tiene rol de administrador.
 */
function esAdmin(): bool {
    return isset($_SESSION['idRol']) && $_SESSION['idRol'] == 1;
}

/**
 * Redirige a una página con un mensaje flash.
 */
function redirigirConMensaje(string $ruta, string $mensaje): void {
    $_SESSION['mensaje'] = $mensaje;
    header("Location: $ruta");
    exit;
}

function validarUsuario($usuario) {
    // Solo letras, números y guiones bajos; mínimo 3 caracteres, máximo 20
    return preg_match('/^[A-Za-z0-9_]{3,20}$/', $usuario);
}

function validarPassword($password) {
    return strlen($password) >= 6;
}

function validarEmail(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function validarEdad($edad): bool {
    return is_numeric($edad) && (int)$edad >= 0 && (int)$edad <= 120;
}

function validarDocumento(string $doc): bool {
    $doc = strtoupper(trim($doc));

    // DNI: 8 dígitos + letra
    $dni = '/^[0-9]{8}[A-Z]$/';

    // NIE: X/Y/Z + 7 dígitos + letra
    $nie = '/^[XYZ][0-9]{7}[A-Z]$/';

    return preg_match($dni, $doc) || preg_match($nie, $doc);
}