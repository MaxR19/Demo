<?php

// Si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];

    // Validamos datos simples
    if (!empty($nombre) && is_numeric($edad)) {
        // Redirigimos con parámetros GET
        header("Location: redireccion_header_parametros_destino.php?nombre=" . urlencode($nombre) . "&edad=" . urlencode($edad));
        exit;
    } else {
        echo "Por favor, introduce un nombre y una edad válidos.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulario de redirección</title>
</head>
<body>

<h2>Formulario</h2>
<form method="post" action="redireccion_header_parametros.php">
    Nombre: <input type="text" name="nombre" required><br/>
    Edad: <input type="number" name="edad" required><br/><br/>
    <input type="submit" value="Enviar">
</form>

</body>
</html>
