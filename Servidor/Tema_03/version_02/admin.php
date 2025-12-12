<?php

/*
admin.php es una página que:
Solo pueden ver los usuarios con rol admin.
Si un usuario "normal" intenta acceder, será redirigido a dashboard.php con un mensaje 
de error.
*/

require 'session_check.php';

/*
Verifica si el usuario ha iniciado sesión.
Si no lo ha hecho, lo envía a login.php y guarda un mensaje en la sesión.
Esto protege cualquier página a la que se le incluya.
Esto garantiza que nadie pueda acceder directamente a admin.php escribiendo la URL sin 
haber hecho login.
*/

if ($_SESSION['rol'] !== 'admin') {
    $_SESSION['mensaje'] = "Acceso denegado: solo admins.";
    header("Location: dashboard.php");
    exit;
}

/*
Esta parte verifica que el usuario tenga rol admin.
Si no es admin:
Se guarda un mensaje de error en $_SESSION['mensaje'].
Se redirige a dashboard.php.
Esto implementa el control de acceso por rol.
*/

?>

<!DOCTYPE html>
<html>
<head><title>Zona Admin</title></head>
<body>

<h2>Zona exclusiva para administradores</h2>
<p>Aquí puedes gestionar cosas reservadas.</p>

<p><a href="dashboard.php">Volver</a></p>

<!--
Esto solo se muestra si el usuario ha pasado las comprobaciones anteriores. Es decir, 
está logueado y es admin.
-->

</body>
</html>
