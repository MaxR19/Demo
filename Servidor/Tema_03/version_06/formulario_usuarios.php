<?php
require_once 'validacion_usuario.php';

$usuario = new Usuario();
$rol = new Rol();

$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : null;
$datosUsuario = $id ? $usuario->obtenerUsuarioPorCampo('id', $id) : null;

if ($id && !$datosUsuario) cambiardePagina('gestion_usuarios.php', 'Usuario no existe.');

$listaUsuarios = $usuario->obtenerUsuarios();
$rolesDisponibles = $rol->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de usuario</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<!-- Formulario de creación de nuevo usuario -->
<h2><?= $id ? 'Editar' : 'Crear nuevo' ?> usuario</h2>
<form method="post" action="guardar_usuario.php">
    <input type="hidden" name="id" value="<?= $id ? (int)$id : '' ?>">

    <label>Usuario:</label><br>
    <input type="text" name="usuario"
       value="<?= $datosUsuario ? htmlspecialchars($datosUsuario->getUsuario()) : '' ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= $datosUsuario ? htmlspecialchars($datosUsuario->getEmail()) : '' ?>" required><br><br>

    <label>Contraseña:</label><br>
    <input type="password" name="password" value="<?= $datosUsuario ? htmlspecialchars($datosUsuario->getPassword()) : '' ?>" required><br><br>

    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="<?= $datosUsuario ? htmlspecialchars($datosUsuario->getNombre()) : '' ?>" required><br><br>

    <label>Apellidos:</label><br>
    <input type="text" name="apellidos" value="<?= $datosUsuario ? htmlspecialchars($datosUsuario->getApellidos()) : '' ?>" required><br><br>

    <?php if (esAdmin()): ?>
        <label>Rol:</label><br>
        <select name="idRol" required>
            <?php foreach ($rolesDisponibles as $r): ?>
                <option value="<?= $r['idRol'] ?>"><?= htmlspecialchars($r['descripcion']) ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit"><?= $id ? 'Guardar cambios' : 'Crear usuario' ?></button>
        <a href="gestion_usuarios.php">Volver</a>
    <?php else : ?>
        <button type="submit">Registrarse</button>
        <a href="index.php">Volver</a>
</form>
</body>
</html>