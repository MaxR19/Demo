<?php

/*
Este archivo muestra un formulario para introducir nombre y apellidos y, cuando el usuario 
lo envía, muestra el resultado en la misma página. Al principio del script se comprueba si 
la petición es de tipo POST; si lo es, se recogen los valores de nombre y apellidos, se 
limpian con htmlspecialchars por seguridad y se construye la variable $nombreCompleto. 
Después, en el body, mediante un if ($esPost) se decide qué contenido mostrar:

- Si la petición es POST, se oculta el formulario y se muestra un bloque con el título 
“Resultado del formulario”, un texto indicando “Tu nombre completo es:” y, debajo, el 
nombre completo calculado. Además, aparece un botón “Volver al formulario” que recarga la 
página (document.location='Ejemplo_02.php') para volver al estado inicial. 
- Si la petición no es POST (primera vez que se entra o al recargar desde el botón), se 
muestra el formulario con los campos de nombre y apellidos y un botón “Enviar”. Todo ello 
está maquetado con estilos CSS embebidos en el propio archivo para darle mejor apariencia 
visual.
*/

$esPost = ($_SERVER['REQUEST_METHOD'] === 'POST');

$nombre = $esPost ? htmlspecialchars($_POST['nombre']) : '';
$apellidos = $esPost ? htmlspecialchars($_POST['apellidos']) : '';
$nombreCompleto = trim("$nombre $apellidos");
?>

<!DOCTYPE html> 
<html> 
    <head> 
        <meta charset="UTF-8"> 
        <title>Ejemplo 02</title>

        <!-- Estilos embebidos -->
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                background-color: #f5f5f5;
                margin: 0;
                padding: 20px;
            }

            h1 {
                color: #333;
            }

            .contenedor {
                background-color: #ffffff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                max-width: 400px;
                margin: 40px auto;
            }

            .campo {
                margin-bottom: 10px;
            }

            .campo label {
                display: inline-block;
                width: 90px;
            }

            .campo input[type="text"] {
                padding: 5px;
                width: 200px;
            }

            .btn {
                padding: 8px 16px;
                border: none;
                background-color: #007bff;
                color: #fff;
                border-radius: 4px;
                cursor: pointer;
            }

            .btn:hover {
                background-color: #0056b3;
            }

            .resultado-titulo {
                margin-bottom: 10px;
            }

            .resultado-texto {
                font-size: 1.1em;
                font-weight: bold;
                color: #007bff;
            }

            .volver {
                display: inline-block;
                margin-top: 15px;
                text-decoration: none;
                color: #007bff;
            }

            .volver:hover {
                text-decoration: underline;
            }
        </style>
    </head> 

    <body> 
        <div class="contenedor">
            <?php if ($esPost): ?>
                <h1 class="resultado-titulo">Resultado del formulario</h1>
                <p>Tu nombre completo es:</p>
                <p class="resultado-texto">
                    <?= $nombreCompleto ?>
                </p>
                <button class="btn" onclick="document.location='Ejemplo_02.php'">Volver al formulario</button>
            <?php else: ?>
                <h1>Mi formulario</h1> 
                <form action="Ejemplo_02.php" method="POST"> 
                    <div class="campo">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre"/>
                    </div>
                    <div class="campo">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" id="apellidos" name="apellidos"/>
                    </div>
                    <button class="btn" type="submit">Enviar</button>
                </form> 
            <?php endif; ?>
        </div>
    </body> 
</html>
