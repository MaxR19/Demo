<?php
//Me traigo el fichero que tiene todas las librerias básicas del proyecto
require_once "utils.php";

//Me traigo el php de ficha guardar para usar la funcion de validar
require_once "ficha_guardar.php";

// Obtenemos la acción del query string
$accion = $_GET['action'] ?? '';

// echo "accion";
// echo $accion;

// Verificamos si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //echo "entra";
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    // echo $usuario;
    // echo $password;
    //Validamos credenciales
    $error = validar();
    //echo $error;

    volverLogin($error);
}

function volverLogin($error = "")
{
    global $usuario;
 
    //Volvemos a la página que ha hecho el submit en caso de error
    if ($error == "") {
        header('Location: listado.php?ok=1');
    } else {
        header('Location: login.php?error=' . $error . '&usuario=' . $usuario . '');
    }
    exit();
}

/*
🧠 Contenido general:
Este archivo maneja el procesamiento del login.

En resumen:
Requiere utilidades (utils.php) y lógica de validación (ficha_guardar.php).
Toma la acción de la URL (action=login, por ejemplo).
Si se envía el formulario (POST), recoge el usuario y password, y llama a validar() (probablemente definida en ficha_guardar.php).
Luego usa volverLogin($error) para redirigir dependiendo de si hubo error o no:
Si todo OK → listado.php?ok=1
Si hay error → vuelve a login.php?error=...
*/