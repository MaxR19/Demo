<?php
/*
Finalidad del archivo: Permite a los usuarios introducir su nombre de usuario y contraseña para iniciar sesión.
Si ya existe una sesión iniciada, redirige automáticamente al usuario al panel correspondiente según su rol.
*/

// Incluimos el archivo de arranque de la aplicación
require_once 'init.php';

// Comprobar si ya hay una sesión iniciada
if (estaLogueado()) {
    // Identificar si la sesión es de un admin o de un usuario normal
    if (esAdmin()) {
        cambiardePagina('admin.php', '');
    } else {
        cambiardePagina('dashboard.php', '');
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<h2>Login</h2>

<!-- Mostrar mensaje de error si existe -->
<?php if (isset($_SESSION['mensaje'])): ?>
    <p style="color:red"><?= htmlspecialchars($_SESSION['mensaje']) ?></p>
    <?php unset($_SESSION['mensaje']); ?>
<?php endif; ?>

<!-- Formulario de login -->
<form method="post" action="autenticacion_usuario.php">
    <label>Usuario:</label><br>
    <input type="text" name="usuario" value="" required><br><br>

    <label>Contraseña:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit" style="display:inline-block; margin-right:10px;">Entrar</button>
    <a href="index.php">Volver</a>
</form>

</body>
</html>