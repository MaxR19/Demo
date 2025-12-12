<?php
// Si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['idioma'])) {
        $idioma = htmlspecialchars($_POST['idioma']);
        
        if ($idioma ==="es") {
            $bienvenida = "Tu nombre completo es ";
        } elseif ($idioma ==="en") {
            $bienvenida = "Your full name is ";
        }
        
        echo $bienvenida. " ". $_POST['nombre']. " ". $_POST["apellidos"];

    } else {
        echo "No seleccionaste ningún idioma.";
    }
    echo '<br><a href="ejemplo_03.php">Volver</a>';
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Selección de idioma</title>
        <script>
            
        </script>
    </head>
<body>
<form method="post" action="ejemplo_03.php">
    Nombre: <input type="text" name="nombre"/><br/> 
    Apellidos: <input type="text" name="apellidos"/><br/> 
    <label>Deseo ser atendido/a en: </label><br/>
    <input type="radio" name="idioma" value="es" onclick=/>Castellano
    <input type="radio" name="idioma" value="en"/>English
    <br/><br/>
    <input type="submit" value="Enviar"/>
</form>

</body>
</html>
