<?php

/*
Objetivo del archivo autenticacion.php
Este archivo se encarga de:
- Recibir los datos del formulario de login.php
- Validar que los datos del formulario no estén vacíos
- Consultar la base de datos obteniendo los datos del usuario
- Verificar la contraseña hasheada
- Crear la sesión (si la autenticación es correcta) o devolviendo al usuario al login con un mensaje de error
- Gestionar la cookie “Recordar usuario”
*/

require_once 'init.php';
require_once './clases/Usuarios.php';

// 1. Recogemos los datos del formulario
$usuario  = trim($_POST['usuario'] ?? '');
$password = $_POST['password'] ?? '';
$recordar = $_POST['recordar'] ?? '';

// 2. Validamos que los datos del formulario no estén vacíos
if ($usuario === '' || $password === '') {
    redirigirConMensaje('login.php', 'Debes rellenar todos los campos.');
}

// 3. Obtener usuario desde la base de datos
$usu = new Usuario();
$user = $usu->obtenerPorUsuario($usuario);

// 4. Verificar credenciales
if (!$user || !password_verify($password, $user['password'])) {
    redirigirConMensaje('login.php', 'Usuario o contraseña incorrectos.');
}

// 5. Autenticación correcta → crear sesión
$_SESSION['usuario'] = $user['usuario'];
$_SESSION['idRol'] = (int) $user['idRol'];
$_SESSION['ultimo_acceso'] = time();

// 6. Cookie "Recordar usuario"
if ($recordar === '1') {
    setcookie(
        'recordar_usuario',
        $usuario,
        time() + (60 * 60 * 24 * 7), // 7 días
        '/',
        '',
        false,
        true // HttpOnly
    );
}

// 7. Redirección final
header("Location: dashboard.php");
exit;