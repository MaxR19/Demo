<?php
require_once 'validacion_usuario.php';

$usuarioModel = new Usuario();
$tipo = $_POST['tipo'] ?? '';

// Cargamos siempre los datos del usuario logueado
$datos = $usuarioModel->obtenerUsuarioPorCampo('usuario', $_SESSION['usuario']);

if (!$datos) {
    $_SESSION['mensaje'] = "No se pudo cargar tu usuario.";
    header("Location: perfil_usuario.php");
    exit;
}

// Usaremos el id para todas las actualizaciones
$idUsuario = (int)$datos->getId();

switch ($tipo) {

    // ================== CAMBIAR NOMBRE DE USUARIO ==================
    case 'usuario':
        $nuevoUsuario = trim($_POST['nuevo_usuario'] ?? '');

        if ($nuevoUsuario === '') {
            $_SESSION['mensaje'] = "El nombre de usuario no puede estar vacío.";
            break;
        }

        if (!validarUsuario($nuevoUsuario)) {
            $_SESSION['mensaje'] = "El nombre de usuario solo puede contener letras, números y guiones bajos (3-20 caracteres).";
            break;
        }

        try {
            $db = conectarDB();

            // ¿Ya existe ese usuario en otro registro?
            $stmt = $db->prepare("SELECT COUNT(*) FROM usuarios WHERE usuario = :usuario AND id != :id");
            $stmt->execute([
                ':usuario' => $nuevoUsuario,
                ':id'      => $idUsuario
            ]);

            if ($stmt->fetchColumn() > 0) {
                $_SESSION['mensaje'] = "Error: ese nombre de usuario ya está en uso.";
                break;
            }

            // Actualizamos
            $stmt = $db->prepare("UPDATE usuarios SET usuario = :usuario WHERE id = :id");
            $stmt->execute([
                ':usuario' => $nuevoUsuario,
                ':id'      => $idUsuario
            ]);

            // Actualizamos también la sesión
            $_SESSION['usuario'] = $nuevoUsuario;
            $_SESSION['mensaje'] = "Nombre de usuario actualizado correctamente.";

        } catch (PDOException $e) {
            $_SESSION['mensaje'] = "Error al actualizar el nombre de usuario.";
        }
        break;

    // ================== CAMBIAR EMAIL ==================
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

        try {
            $db = conectarDB();

            // ¿Ya existe ese email en otro usuario?
            $stmt = $db->prepare("SELECT COUNT(*) FROM usuarios WHERE email = :email AND id != :id");
            $stmt->execute([
                ':email' => $nuevoEmail,
                ':id'    => $idUsuario
            ]);

            if ($stmt->fetchColumn() > 0) {
                $_SESSION['mensaje'] = "Error: ese email ya está en uso.";
                break;
            }

            // Actualizamos
            $stmt = $db->prepare("UPDATE usuarios SET email = :email WHERE id = :id");
            $stmt->execute([
                ':email' => $nuevoEmail,
                ':id'    => $idUsuario
            ]);

            $_SESSION['mensaje'] = "Email actualizado correctamente.";

        } catch (PDOException $e) {
            $_SESSION['mensaje'] = "Error al actualizar el email.";
        }
        break;

    // ================== CAMBIAR CONTRASEÑA ==================
    case 'password':
        $actual    = $_POST['actual'] ?? '';
        $nueva     = $_POST['nueva'] ?? '';
        $confirmar = $_POST['confirmar'] ?? '';

        // 1. Comprobar contraseña actual
        if (!password_verify($actual, $datos->getPassword())) {
            $_SESSION['mensaje'] = "La contraseña actual no es correcta.";
            break;
        }

        // 2. Comprobar que coinciden nueva y confirmar
        if ($nueva !== $confirmar) {
            $_SESSION['mensaje'] = "Las nuevas contraseñas no coinciden.";
            break;
        }

        // 3. Validar longitud mínima
        if (!validarPassword($nueva)) {
            $_SESSION['mensaje'] = "La nueva contraseña debe tener al menos 6 caracteres.";
            break;
        }

        try {
            $db = conectarDB();
            $hash = password_hash($nueva, PASSWORD_DEFAULT);

            $stmt = $db->prepare("UPDATE usuarios SET password = :pass WHERE id = :id");
            $stmt->execute([
                ':pass' => $hash,
                ':id'   => $idUsuario
            ]);

            $_SESSION['mensaje'] = "Contraseña actualizada correctamente.";

        } catch (PDOException $e) {
            $_SESSION['mensaje'] = "Error al actualizar la contraseña.";
        }
        break;

    default:
        $_SESSION['mensaje'] = "Acción no válida.";
        break;
}

// Volvemos siempre al perfil
header("Location: perfil_usuario.php");
exit;
