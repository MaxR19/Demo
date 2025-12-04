<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreUsuario = strip_tags($_POST['nombre']);

    if (!empty($nombreUsuario)) {
        $_SESSION['nombre'] = $nombreUsuario;
        header("Location: bienvenida.php");
        exit;
    } else {
        $error = "Por favor, introduce tu nombre.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Iniciar sesión</title>
</head>
<body>

<h2>Inicio de sesión</h2>

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="post" action="login.php">
    Nombre: <input type="text" name="nombre" required><br><br>
    <input type="submit" value="Entrar">
</form>

</body>
</html>
