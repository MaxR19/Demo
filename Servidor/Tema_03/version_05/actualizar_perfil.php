<?php
require_once 'init.php';
require_once 'validacion_usuarios.php';
require_once './clases/Usuarios.php';

$usu  = new Usuario();
$tipo = $_POST['tipo'] ?? '';

switch ($tipo) {

    case 'usuario':
        $nuevo = trim($_POST['nuevo_usuario'] ?? '');

        if ($nuevo === '') {
            $_SESSION['mensaje'] = "El nombre de usuario no puede estar vacío.";
            break;
        }

        if (!validarUsuario($nuevo)) {
            $_SESSION['mensaje'] = "El nombre de usuario solo puede contener letras, números y guiones bajos (3-20 caracteres).";
            break;
        }

        if ($usu->actualizarNombre($_SESSION['usuario'], $nuevo)) {
            $_SESSION['usuario'] = $nuevo;
            $_SESSION['mensaje'] = "Nombre de usuario actualizado correctamente.";
        } else {
            $_SESSION['mensaje'] = "Error: ese nombre ya está en uso.";
        }
        break;

    case 'email':
        $nuevoEmail = trim($_POST['nuevo_email'] ?? '');

        if ($nuevoEmail === '') {
            $_SESSION['mensaje'] = "El email no puede estar vacío.";
            break;
        }

        if (!validarEmail($nuevoEmail)) {
            $_SESSION['mensaje'] = "El email no tiene un formato válido.";
            break;
        }

        $datos = $usu->obtenerPorUsuario($_SESSION['usuario']);
        if (!$datos) {
            $_SESSION['mensaje'] = "No se pudo cargar tu usuario.";
            break;
        }

        if ($usu->actualizarEmail((int)$datos['id'], $nuevoEmail)) {
            $_SESSION['mensaje'] = "Email actualizado correctamente.";
        } else {
            $_SESSION['mensaje'] = "Error: ese email ya está en uso.";
        }
        break;

    case 'password':
        $actual    = $_POST['actual'] ?? '';
        $nueva     = $_POST['nueva'] ?? '';
        $confirmar = $_POST['confirmar'] ?? '';

        $datos = $usu->obtenerPorUsuario($_SESSION['usuario']);

        if (!$datos) {
            $_SESSION['mensaje'] = "No se pudo cargar tu usuario.";
            break;
        }

        if (!password_verify($actual, $datos['password'])) {
            $_SESSION['mensaje'] = "La contraseña actual no es correcta.";
            break;
        }

        if ($nueva !== $confirmar) {
            $_SESSION['mensaje'] = "Las nuevas contraseñas no coinciden.";
            break;
        }

        if (!validarPassword($nueva)) {
            $_SESSION['mensaje'] = "La nueva contraseña debe tener al menos 6 caracteres.";
            break;
        }

        $usu->actualizarPassword((int)$datos['id'], $nueva);
        $_SESSION['mensaje'] = "Contraseña actualizada correctamente.";
        break;

    default:
        $_SESSION['mensaje'] = "Acción no válida.";
        break;
}

header("Location: perfil_usuario.php");
exit;