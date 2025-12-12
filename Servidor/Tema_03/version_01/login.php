<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>

<h2>Login</h2>
<?php
if (isset($_SESSION['mensaje'])) {
    echo "<p style='color:red'>{$_SESSION['mensaje']}</p>";
    unset($_SESSION['mensaje']);
}
?>

<form method="post" action="auth.php">
    Usuario: <input type="text" name="usuario" required><br>
    Contraseña: <input type="password" name="password" required><br>
    <button type="submit">Entrar</button>
</form>

</body>
</html>
