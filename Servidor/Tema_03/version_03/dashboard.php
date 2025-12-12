<?php
require 'session_check.php';
?>

<!DOCTYPE html>
<html>
<head><title>Panel</title></head>
<body>
<h2>Hola, <?= htmlspecialchars($_SESSION['usuario']) ?></h2>
<p>Tu rol: <?= $_SESSION['rol'] ?></p>

<?php if ($_SESSION['rol'] === 'admin'): ?>
    <p><a href="admin.php">Ir a zona de admins</a></p>
<?php endif; ?>

<p><a href="logout.php">Cerrar sesión</a></p>
</body>
</html>
