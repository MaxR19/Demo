<?php

/*
Es la página principal del usuario autenticado, donde se le da la bienvenida, se muestra 
su rol, y si es administrador, se le ofrece acceso a una zona exclusiva (admin.php).
*/

require 'session_check.php';

/*
Este archivo se carga al principio para asegurarse de que el usuario ha iniciado sesión.
Si no hay sesión iniciada (es decir, si $_SESSION['usuario'] no existe), el usuario es 
redirigido automáticamente a login.php.
Este control viene desde session_check.php, que hace:
evita que accedan directamente a dashboard.php sin autenticación.
*/

?>

<!DOCTYPE html>
<html>
<head><title>Panel de Usuario</title></head>
<body>

<h2>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?></h2>
<p>Rol: <?= htmlspecialchars($_SESSION['rol']) ?></p>

<!-- 
Mostrar el nombre del usuario y su rol
Se muestra el nombre del usuario y su rol (por ejemplo: admin o usuario).
Se usa htmlspecialchars() para evitar ataques XSS si algún valor se ha guardado con 
caracteres especiales.

¿De dónde vienen estos datos?
De auth.php, que los guarda en la sesión cuando el login es exitoso:
-->

<?php if ($_SESSION['rol'] === 'admin'): ?>
    <p><a href="admin.php">Ir a zona de administración</a></p>
<?php endif; ?>

<!-- 
Acceso al área de administración (solo admins)
Solo se muestra este enlace si el rol del usuario es exactamente 'admin'.
Esta lógica de control no reemplaza la seguridad en admin.php, solo oculta el enlace. 
Por eso admin.php también verifica el rol al principio:
-->

<p><a href="logout.php">Cerrar sesión</a></p>

<!--
Enlace directo a logout.php, que hace lo siguiente:
Con esto, la sesión se borra completamente y se vuelve a la página de login.
-->

</body>
</html>
