<?php

// Si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];

    // Verificamos si el usuario es "admin"
    if ($usuario === 'admin') {
        // Redirige a la página de bienvenida
        header("Location: ejemplo_redireccion_bienvenida.php");
        exit; // Siempre se debe usar exit después de header
    } else {
        // Redirige a una página de error
        header("Location: ejemplo_redireccion_error.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Redirección con header()</title>
</head>
<body>

<h2>Formulario de acceso</h2>
<form method="post" action="ejemplo_redireccion_header.php">
    Usuario: <input type="text" name="usuario" required><br><br>
    <input type="submit" value="Entrar">
</form>

</body>
</html>
