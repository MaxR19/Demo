<?php
require_once 'init.php';
require_once 'session_check.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Usuario</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<h2>Bienvenido, <?= htmlspecialchars($_SESSION['usuario'], ENT_QUOTES, 'UTF-8') ?></h2>

<p>Tu rol actual: <?= esAdmin() ? 'Administrador' : 'Usuario estándar' ?></p>

<?php if (esAdmin()): ?>
    <p><a href="admin.php">Ir a la zona de administración</a></p>

    <!-- Menú nuevo -->
    <p><a href="gestion_clientes.php">Gestión de clientes</a></p>
    <p><a href="contactos.php">Listado global de contactos</a></p>
<?php endif; ?>

<p><a href="profile.php">Ver/Editar Perfil</a></p>
<p><a href="logout.php">Cerrar sesión</a></p>

</body>
</html>
