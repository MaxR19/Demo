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

// Recogemos los datos del formulario de login
$nombreUsuario  = trim($_POST['usuario'] ?? '');
$password = $_POST['password'] ?? '';
$recordar = $_POST['recordar'] ?? '';

// 2. Validamos que los datos del formulario no estén vacíos
if ($nombreUsuario === '' || $password === '') {
    cambiardePagina('login.php', 'Debes rellenar todos los campos.');
}

// 3. Obtenemos el usuario desde la base de datos a partir del nombre de usuario
$user = (new Usuario())->obtenerUsuarioPorCampo('usuario', $nombreUsuario);

// 4. Verificar credenciales
if (!$user || !password_verify($password, $user->getPassword())) {
    cambiardePagina('login.php', 'Usuario o contraseña incorrectos.');
}

// 5. Autenticación correcta → crear sesión
$_SESSION['usuario'] = $user->getUsuario();
$_SESSION['idRol'] = (int) $user->getRolId();
$_SESSION['ultimo_acceso'] = time();

// 7. Redirección final
if (estaLogueado()) {
    // Identificar si la sesión es de un admin o de un usuario normal
    if (esAdmin()) {
        cambiardePagina('admin.php', '');
    } else {
        cambiardePagina('dashboard.php', '');
    }
}
exit;