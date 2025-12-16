<?php
require_once 'validacion_usuario.php';

$id        = isset($_POST['id']) && is_numeric($_POST['id']) ? (int)$_POST['id'] : null;
$usuario    = trim($_POST['usuario'] ?? '');
$email     = trim($_POST['email'] ?? '');
$password  = trim($_POST['password'] ?? '');
$nombre    = trim($_POST['nombre'] ?? '');
$apellidos = trim($_POST['apellidos'] ?? '');
$rol      = trim($_POST['idRol'] ?? '');

if ($usuario === '' || $email === ''|| $nombre === '' || $apellidos === '' || $rol === '') {
    cambiardePagina($id ? "formulario_usuarios.php?id=$id" : "formulario_usuarios.php", "Debes completar todos los campos.");
}

if (!validarUsuario($usuario)) {
    cambiardePagina($id ? "formulario_usuarios.php?id=$id" : "formulario_usuarios.php", "Usuario no válido.");
}

if (!validarEmail($email)) {
    cambiardePagina($id ? "formulario_usuarios.php?id=$id" : "formulario_usuarios.php", "Email no válido.");
}

if (!validarPassword($password)) {
    cambiardePagina($id ? "formulario_usuarios.php?id=$id" : "formulario_usuarios.php", "Contraseña no válida (mínimo 6 caracteres).");
}

if (!validarNombre($nombre)) {
    cambiardePagina($id ? "formulario_usuarios.php?id=$id" : "formulario_usuarios.php", "Nombre no válido.");
}

if (!validarApellidos($apellidos)) {
    cambiardePagina($id ? "formulario_usuarios.php?id=$id" : "formulario_usuarios.php", "Apellidos no válidos.");
}

if( !is_numeric($rol) || (int)$rol <= 0 ) {
    cambiardePagina($id ? "formulario_usuarios.php?id=$id" : "formulario_usuarios.php", "Rol no válido.");
}



$user = new Usuario();
$ok = $id
    ? $user->actualizar($id, $usuario, $password, $email, $nombre, $apellidos, (int)$rol)
    : $user->insertar($usuario, $password, $email, $nombre, $apellidos, (int)$rol);

if (esAdmin()) {
    cambiardePagina(
        'gestion_usuarios.php', 
        $ok ? "Usuario guardado correctamente." : "Error al guardar el usuario."
    );
} else {
    cambiardePagina(
        'login.php', 
        $ok ? "Usuario registrado correctamente." : "Error al registrarse."
    );
}