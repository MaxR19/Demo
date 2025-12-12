<?php

/*
Este archivo es el encargado de cerrar correctamente la sesión del usuario cuando este 
decide salir del sistema.
*/

session_start();

/*
Inicia la sesión actual, o bien accede a la que ya está abierta.
Esto es obligatorio para poder modificar o destruir la sesión.
*/

session_unset();

/*
Limpia todas las variables de sesión, es decir, elimina los datos almacenados en $_SESSION, como:
$_SESSION['usuario']
$_SESSION['rol']
$_SESSION['mensaje'] (si existiera)
No destruye la sesión en sí, solo vacía su contenido.
*/

session_destroy();

/*
Elimina completamente la sesión del servidor.
Cierra la sesión actual y borra el archivo temporal en el que PHP guarda esos datos.
*/

header("Location: login.php");

/*
Redirige al usuario de nuevo a la página de login.
Así, después de cerrar sesión, el usuario no se queda en una página protegida, sino que 
vuelve al punto de inicio.
*/

exit;

/*
Detiene la ejecución del script inmediatamente después de redirigir.
*/