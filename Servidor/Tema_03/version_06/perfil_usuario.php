<?php
require_once 'validacion_usuario.php';

// Obtener los datos actuales del usuario desde la base de datos
$usuario = new Usuario();
$datos = $usuario->obtenerUsuarioPorCampo('usuario', $_SESSION['usuario']);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<h2>Mi Perfil</h2>

<?php if ($mensaje): ?>
    <p style="color: green;"><?= htmlspecialchars($mensaje) ?></p>
<?php endif; ?>

<!-- Formulario para cambiar nombre de usuario -->
<h3>Cambiar nombre de usuario</h3>
<form method="post" action="actualizar_perfil.php">
    <input type="hidden" name="tipo" value="usuario">
    <label>Nuevo nombre de usuario:</label><br>
    <input type="text" name="nuevo_usuario" value="<?= htmlspecialchars($datos->getUsuario()) ?>" required><br><br>
    <button type="submit">Actualizar nombre</button>
</form>

<!-- Formulario para cambiar contraseña -->
<h3>Cambiar contraseña</h3>
<form method="post" action="actualizar_perfil.php">
    <input type="hidden" name="tipo" value="password">
    
    <label>Contraseña actual:</label><br>
    <input type="password" name="actual" required><br><br>

    <label>Nueva contraseña:</label><br>
    <input type="password" name="nueva" required><br><br>

    <label>Confirmar nueva contraseña:</label><br>
    <input type="password" name="confirmar" required><br><br>

    <button type="submit">Actualizar contraseña</button>
</form>

<!-- Formulario para cambiar email -->
<h3>Cambiar email</h3>
<form method="post" action="actualizar_perfil.php">
    <input type="hidden" name="tipo" value="email">

    <label>Nuevo email:</label><br>
    <input type="email" name="nuevo_email" value="<?= htmlspecialchars($datos->getEmail() ?? '') ?>" required><br><br>

    <button type="submit">Actualizar email</button>
</form>

<br>
<p><a href="dashboard.php">← Volver al panel</a></p>

</body>
</html>