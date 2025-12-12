<?php

/*
Es un filtro de seguridad que se encarga de verificar que el usuario haya iniciado 
sesión antes de permitir el acceso a una página protegida (por ejemplo, dashboard.php 
o admin.php).
*/

session_start();

/*
session_start();

Esto activa las variables de sesión para que se pueda acceder a $_SESSION.
Sin esta línea, PHP no puede saber si un usuario está logueado, porque no se cargan 
los datos guardados en la sesión.
*/

if (!isset($_SESSION['usuario'])) {
    $_SESSION['mensaje'] = "Debes iniciar sesión primero.";

    /*
    Bloquea el acceso:
    Guarda un mensaje de error que luego será mostrado en login.php.
    */

    header("Location: login.php");
    exit;

    /*
    El usuario es redirigido automáticamente a la página de login.
    exit; detiene el resto del script para evitar que la página actual se siga ejecutando.
    */
}

/*
Esta condición comprueba si no existe la variable de sesión 'usuario'.
En otras palabras:
Si la sesión del usuario no está activa (es decir, no ha hecho login)…
Entonces ejecuta el bloque dentro del if.
*/