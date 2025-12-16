<?php

/*
Finalidad del archivo:
Permite a un usuario registrado iniciar sesión introduciendo su nombre de usuario y 
contraseña.
Si elige la opción "Recordar usuario", se guarda su nombre en una cookie.
Si ya tiene sesión iniciada, lo redirige automáticamente al panel (dashboard.php).
*/

require_once 'init.php';

// Si ya ha iniciado sesión, redirige al dashboard
if (estaLogueado()) {
    header("Location: dashboard.php");
    exit;
}

// Recuperar el valor de la cookie si existe
$usuario_cookie = $_COOKIE['recordar_usuario'] ?? '';
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
<form method="post" action="autenticacion.php">
    <label>Usuario:</label><br>
    <input type="text" name="usuario" value="<?= htmlspecialchars($usuario_cookie)?>" required><br><br>

    <label>Contraseña:</label><br>
    <input type="password" name="password" required><br><br>

    <label>
        <input type="checkbox" name="recordar" value="1">
        Recordar usuario
    </label><br><br>

    <button type="submit">Entrar</button>
</form>

<p><a href="index.php">Volver al inicio</a></p>

</body>
</html>