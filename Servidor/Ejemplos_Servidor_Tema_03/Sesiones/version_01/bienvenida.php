<?php
session_start();

if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit;
}

$usuario = htmlspecialchars($_SESSION['nombre']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bienvenida</title>
</head>
<body>

<h2>Bienvenido, <?= $usuario ?> 👋</h2>
<p>Esta es tu sesión activa.</p>

<a href="cerrar.php">Cerrar sesión</a>

</body>
</html>
