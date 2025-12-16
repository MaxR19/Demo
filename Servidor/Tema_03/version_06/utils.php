<?php

// Este archivo reúne las funciones auxiliares y de validación que usa la aplicación

// FUNCIONES AUXILIARES

// Verificamos si un usuario ya hubiera iniciado sesión.
function estaLogueado(): bool {
    return isset($_SESSION['usuario']) && !empty($_SESSION['usuario']);
}

// Verificamos si el usuario tiene rol de administrador o no.
function esAdmin(): bool {
    return isset($_SESSION['idRol']) && $_SESSION['idRol'] == 1;
}

// Redirigimos al usuario a una página específica (con un mensaje opcional).
function cambiardePagina(string $ruta, string $mensaje): void {
    if (!empty($mensaje)) {
        $_SESSION['mensaje'] = $mensaje;
        header("Location: $ruta");
        exit;
    } else {
        header("Location: $ruta");
        exit;  
    }
}

// VALIDACIONES

// Validar un nombre de usuario que solo admita letras, números y guiones bajos (entre 3 y 20 caracteres).
function validarUsuario($usuario) {
    return preg_match('/^[A-Za-z0-9_]{3,20}$/', $usuario);
}

// Validar una contraseña que tenga al menos 6 caracteres.
function validarPassword($password) {
    return strlen($password) >= 6;
}

// Validar que tenga un formato de email válido.
function validarEmail(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Validar una edad entre 0 y 120 años.
function validarEdad($edad): bool {
    return is_numeric($edad) && (int)$edad >= 0 && (int)$edad <= 120;
}

// Validar un documento de identidad (DNI o NIE) español.
function validarDocumento(string $doc): bool {
    $doc = strtoupper(trim($doc));

    // DNI: 8 dígitos + letra
    $dni = '/^[0-9]{8}[A-Z]$/';

    // NIE: X/Y/Z + 7 dígitos + letra
    $nie = '/^[XYZ][0-9]{7}[A-Z]$/';

    return preg_match($dni, $doc) || preg_match($nie, $doc);
}

// Validar nombre: solo letras (incluye acentos), espacios y guiones, 2-50 caracteres
function validarNombre($nombre): bool {
    $nombre = trim($nombre);

    return (bool) preg_match(
        '/^[A-Za-zÁÉÍÓÚÜáéíóúüÑñ\- ]{2,50}$/u',
        $nombre
    );
}

// Validar apellidos: igual que nombre, 2-50 caracteres
function validarApellidos($apellidos): bool {
    $apellidos = trim($apellidos);

    return (bool) preg_match(
        '/^[A-Za-zÁÉÍÓÚÜáéíóúüÑñ\- ]{2,50}$/u',
        $apellidos
    );
}