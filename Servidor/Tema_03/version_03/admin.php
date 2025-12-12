<?php
require 'session_check.php';

if ($_SESSION['rol'] !== 'admin') {
    $_SESSION['mensaje'] = "No tienes permisos de admin.";
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Zona admin</title></head>
<body>
<h2>Zona restringida a administradores</h2>

<p><a href="dashboard.php">Volver</a></p>
</body>
</html>
