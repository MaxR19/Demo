<?php
require 'session_check.php';
?>

<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>

<h2>Zona privada</h2>
<p>Hola, <?= htmlspecialchars($_SESSION['usuario']) ?> (Rol: <?= $_SESSION['rol'] ?>)</p>

<?php if ($_SESSION['rol'] === 'admin'): ?>
    <p><a href="admin.php">Ir a zona de admins</a></p>
<?php endif; ?>

<p><a href="logout.php">Cerrar sesión</a></p>

</body>
</html>
