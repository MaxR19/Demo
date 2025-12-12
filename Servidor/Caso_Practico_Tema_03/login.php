<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $password = trim($_POST['password']);

    if (isset($_SESSION['usuarios'][$nombre])) {
        $usuario = $_SESSION['usuarios'][$nombre];
        if ($usuario['password'] === $password) {
            $_SESSION['nombre'] = $nombre;
            $_SESSION['rol'] = $usuario['rol'];
            header("Location: bienvenida.php");
            exit;
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no registrado.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Iniciar sesión</h2>

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="post" action="login.php">
    Nombre: <input type="text" name="nombre" required><br><br>
    Contraseña: <input type="password" name="password" required><br><br>
    <input type="submit" value="Entrar">
</form>

<p><a href="index.php">Volver al inicio</a></p>

</body>
</html>
