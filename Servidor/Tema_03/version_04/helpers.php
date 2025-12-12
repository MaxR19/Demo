<?php

function estaLogueado(): bool {
    return isset($_SESSION['usuario']) && !empty($_SESSION['usuario']);
}

function esAdmin(): bool {
    return isset($_SESSION['idRol']) && $_SESSION['idRol'] == 1;
}

function redirigirConMensaje(string $ruta, string $mensaje): void {
    $_SESSION['mensaje'] = $mensaje;
    header("Location: $ruta");
    exit;
}

function validarUsuario($usuario) {
    return preg_match('/^[A-Za-z0-9_]{3,20}$/', $usuario);
}

function validarPassword($password) {
    return strlen($password) >= 6;
}

function validarEmail(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/** ======== VALIDACIONES CLIENTES (las usas en guardar_cliente.php) ======== */
function validarEdad($edad): bool {
    return is_numeric($edad) && (int)$edad >= 0 && (int)$edad <= 120;
}

/**
 * Valida formato DNI/NIE (España) sin calcular letra.
 * DNI: 8 dígitos + letra
 * NIE: X/Y/Z + 7 dígitos + letra
 */
function validarDocumento(string $doc): bool {
    $doc = strtoupper(trim($doc));

    $dni = '/^[0-9]{8}[A-Z]$/';
    $nie = '/^[XYZ][0-9]{7}[A-Z]$/';

    return preg_match($dni, $doc) || preg_match($nie, $doc);
}

/** ======== VALIDACIONES CONTACTOS (teléfono España) ======== */
function normalizarTelefonoES(string $tel): string {
    $tel = trim($tel);

    // Quitar espacios, guiones, puntos, paréntesis
    $tel = preg_replace('/[\s\-\.\(\)]/', '', $tel);

    // Permitir prefijo +34 o 34
    if (strpos($tel, '+34') === 0) {
        $tel = substr($tel, 3);
    } elseif (strpos($tel, '34') === 0 && strlen($tel) > 9) {
        $tel = substr($tel, 2);
    }

    return $tel;
}

function validarTelefonoES(string $tel): bool {
    $tel = normalizarTelefonoES($tel);

    // 9 dígitos, empieza por 6/7 (móvil) u 8/9 (fijo)
    return preg_match('/^[6-9]\d{8}$/', $tel) === 1;
}
