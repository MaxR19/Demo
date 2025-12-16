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

require_once 'validacion_usuario.php';

// Manejamos redirecciones basadas en el parámetro 'pagina' que se recibe por el método GET
if (isset($_GET['pagina'])) {
    // Sanitizar para evitar XSS
    $valor = htmlspecialchars($_GET['pagina']); 

    if ($valor === 'perfil') {
        cambiardePagina('perfil_usuario.php', '');
    } elseif ($valor === 'salir') {
        cambiardePagina('cerrar_sesion.php.php', '');
    } else {
        cambiardePagina('dashboard.php', 'Opción no válida.');
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Usuario</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h2>Panel de Usuario</h2>

    <?php if (isset($_SESSION['mensaje'])): ?>
    <p style="color:green"><?= htmlspecialchars($_SESSION['mensaje']) ?></p>
    <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>

    <!-- Un formulario con dos botones: uno para login.php y otro para registro.php. Se usa el
    método GET para redireccionar al usuario. -->
    <form method="get" action="dashboard.php" style="display:inline-block; margin-right:10px;">
        <button type="submit" name="pagina" value="perfil">Ver/Editar Perfil</button>
        <button type="submit" name="pagina" value="salir">Cerrar sesión</button>
    </form>
</body>
</html>