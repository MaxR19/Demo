<?php

/*
Este archivo es la zona privada general a la que acceden todos los usuarios después de 
iniciar sesión correctamente, ya sean administradores o usuarios normales.

Objetivo de dashboard.php
Mostrar un mensaje de bienvenida.
Mostrar el rol del usuario.
Si el usuario es admin, mostrar un enlace a la zona de administración.
Mostrar opción de cerrar sesión.
Proteger el acceso usando session_check.php.
*/

require_once 'init.php';
require_once 'validacion_usuario.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Usuario</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<h2>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?></h2>

<p>Tu rol actual: <?= esAdmin() ? 'Administrador' : 'Usuario estándar' ?></p>

<?php if (esAdmin()): ?>
    <p><a href="admin.php">Ir a la zona de administración</a></p>
<?php endif; ?>

<p><a href="perfil_usuario.php">Ver/Editar Perfil</a></p>
<p><a href="cerrar_sesion.php">Cerrar sesión</a></p>

</body>
</html>