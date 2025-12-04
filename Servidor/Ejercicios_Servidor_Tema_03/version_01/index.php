<?php
// Importo el archivo utils.php que tiene todas las librerias básicas del proyecto
require_once "utils.php";

// Llamo a una función definida probablemente en utils.php que destruye o limpia la sesión activa.
// Esto es común cuando el objetivo es comenzar desde cero (por ejemplo, al ir al login), asegurando que ningún usuario quede logueado por accidente.
borrarSesion();
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="./estilos/estilos.css">
    <title>Inicio</title>
    <script src="./scripts/scripts.js"></script>
</head>

<body>
    <div class="container">
        <form id="frmInicio" name="frmInicio" action="" method="post">
            <!-- Muestra un mensaje de bienvenida. -->
            <h1>Bienvenido</h1>
            <!-- Contiene un formulario (<form>) pero sin acción definida, no envía datos (porque los botones no son type="submit"). -->
            <!-- "Crear nuevo usuario": llama a una función JS IrFicha() al hacer clic. -->
            <button class="btn primary" onclick="IrFicha()">Crear nuevo usuario</button>
            <!-- "Login": llama a otra función JS IrLogin(). -->
            <button class="btn secondary" onclick="IrLogin()">Login</button>
        </form>
    </div>
</body>

</html>

<!-- Este index.php sirve como pantalla inicial del sitio. Lo que hace:

- Carga funciones comunes (utils.php).
- Limpia cualquier sesión activa (cierre de sesión).
- Muestra un mensaje de bienvenida.

Ofrece dos botones:
- Uno para registrar nuevo usuario.
- Otro para hacer login. -->