<?php
/*
El archivo login.php es la página de acceso (login) del sistema. Su función principal 
es mostrar un formulario de autenticación donde el usuario escribe su nombre de usuario 
y contraseña, y al enviarlo, se comprueban sus credenciales a través de auth.php.
*/

session_start();

/*
Inicio de sesión:
Inicia (o continúa) una sesión PHP.
Permite acceder a variables de sesión como $_SESSION['usuario'], $_SESSION['mensaje'], etc.
Todas las páginas que manejan sesiones deben empezar con session_start().
*/

if (isset($_SESSION['usuario'])) {
    header("Location: dashboard.php");
    exit;
}

/*
Redirección si el usuario ya está autenticado:
Si el usuario ya tiene una sesión activa (es decir, ya hizo login), se le redirige 
directamente a dashboard.php, evitando que vuelva a loguearse.
Es una medida de usabilidad y seguridad: un usuario autenticado no necesita ver la página 
de login de nuevo.
*/
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>

<h2>Iniciar sesión</h2>

<?php
if (isset($_SESSION['mensaje'])) {
    echo "<p style='color:red'>{$_SESSION['mensaje']}</p>";
    unset($_SESSION['mensaje']);
}

/*
Mostrar mensajes de error desde la sesión:
Si hay algún mensaje de error (por ejemplo: "usuario o contraseña incorrectos", o "debes iniciar sesión"), lo muestra.
Luego, elimina el mensaje de la sesión para que no se muestre permanentemente en futuras visitas.
Este mensaje puede haber sido creado en auth.php o session_check.php.
*/
?>

<form method="post" action="auth.php">
    <label>Usuario:</label>
    <input type="text" name="usuario" required><br>

    <label>Contraseña:</label>
    <input type="password" name="password" required><br><br>

    <button type="submit">Entrar</button>
</form>

<!--
Formulario de acceso:
El formulario envía los datos por POST al archivo auth.php.
Los campos enviados son usuario y password.
El botón envía el formulario a auth.php, donde se hará la verificación.
-->

</body>
</html>
