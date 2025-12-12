<!DOCTYPE html>
<html>
<head>
    <title>Validación y Saneamiento</title>
</head>
<body>

    <?php
    
    // Comprobamos si se ha recibido el parámetro 'nombre' por GET
    if (isset($_GET['nombre'])) {

        // Saneamos la entrada de dos formas distintas
        $nombre01 = strip_tags($_GET['nombre']);
        $nombre02 = htmlspecialchars($_GET['nombre']);

        // Mostramos el resultado
        echo "Nombre saneado con strip_tags: " . $nombre01 . "<br/>";
        echo "Nombre saneado con htmlspecialchars: " . $nombre02 . "<br/>";

    } else {
        echo "No has introducido tu nombre en la URL.<br/>";
        echo 'Ejemplo de uso: <a href="?nombre=<script>alert(1)</script>">Haz clic para probar suplantación</a>';
    }
    ?>

<h2>Formulario de prueba</h2>
<form method="get" action="suplantacion_get.php">
    Nombre: <input type="text" name="nombre" required><br/>
    <input type="submit" value="Enviar">
</form>

</body>
</html>