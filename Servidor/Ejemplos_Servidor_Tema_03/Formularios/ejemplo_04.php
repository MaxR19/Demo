<?php

function validarDatos($parametro) {
    return !empty($parametro) || $parametro === '0' || $parametro === 0;
}

// Si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];

    if (validarDatos($nombre) && validarDatos($apellidos)) {

        echo"Hola, ". htmlspecialchars($nombre) . " " . htmlspecialchars($apellidos) . "<br/>";

        $interes = isset($_POST['interes']) ? $_POST['interes'] : [];

        if (validarDatos($interes)) {
            echo"Tus intereses son: <br/>";
            foreach ($interes as $valor) {
            echo "- " . htmlspecialchars($valor) . "<br/>";
            }
        } else {
            echo "No seleccionaste ningún interés.";
        }
    } else {
         echo "Error.";
    }
    
    echo '<br><a href="ejemplo_04.php">Volver</a>';
    exit;
}



?>

<!DOCTYPE html>
<html>
    <head>
        <title>Selección de idioma</title>
    </head>
<body>
<form method="post" action="ejemplo_04.php">
    Nombre: <input type="text" name="nombre"/><br/> 
    Apellidos: <input type="text" name="apellidos"/><br/> 
    
    <label>Mis intereses: </label><br/> 
    <input type="checkbox" name="interes[]" value="Deportes"/>Deportes<br/> 
    <input type="checkbox" name="interes[]" value="Música"/>Música<br/> 
    <input type="checkbox" name="interes[]" value="Libros"/>Libros<br/> 
    <input type="checkbox" name="interes[]" value="Cine"/>Cine<br/> 
    <br/>
    <input type="submit" value="Enviar"/>
</form>

</body>
</html>