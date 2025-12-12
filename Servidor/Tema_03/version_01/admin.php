<?php
require 'session_check.php';

if ($_SESSION['rol'] !== 'admin') {
    $_SESSION['mensaje'] = "No tienes permiso para acceder a la zona de administración.";
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Admin</title></head>
<body>

<h2>Panel de administración</h2>
<p>Solo visible por administradores.</p>

<p><a href="dashboard.php">Volver</a></p>

</body>
</html>
