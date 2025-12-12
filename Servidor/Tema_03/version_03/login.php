<?php
session_start();

// Si ya hay sesión activa, redirige
if (isset($_SESSION['usuario'])) {
    header("Location: dashboard.php");
    exit;
}

// Si hay cookie, repone el usuario
$usuario_cookie = $_COOKIE['recordar_usuario'] ?? '';
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<h2>Iniciar sesión</h2>

<?php
if (isset($_SESSION['mensaje'])) {
    echo "<p style='color:red'>{$_SESSION['mensaje']}</p>";
    unset($_SESSION['mensaje']);
}
?>

<form method="post" action="auth.php">
    <label>Usuario:</label>
    <input type="text" name="usuario" value="<?= htmlspecialchars($usuario_cookie) ?>" required><br>

    <label>Contraseña:</label>
    <input type="password" name="password" required><br>

    <label>
        <input type="checkbox" name="recordar" value="1"> Recuérdame
    </label><br><br>

    <button type="submit">Entrar</button>
</form>
</body>
</html>
