<?php

// Si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Saneamiento con strip_tags
    $nombre01 = strip_tags($_POST['nombre']);

    // Saneamiento con htmlspecialchars
    $nombre02 = htmlspecialchars($_POST['nombre']);

    // Validación del email con filter_var
    $email = $_POST['email'];
    $emailValido = filter_var($email, FILTER_VALIDATE_EMAIL);

    echo "Nombre saneado con strip_tags: " . $nombre01 . "<br/>";
    echo "Nombre saneado con htmlspecialchars: " . $nombre02 . "<br/><br/>";

    if ($emailValido) {
        echo "Email válido: " . htmlspecialchars($email) . "<br/>";
    } else {
        echo "Email no válido<br/>";
    }

    echo '<br><a href="validacion_saneamiento.php">Volver</a>';
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Validación y Saneamiento</title>
</head>
<body>

<h2>Formulario de prueba</h2>
<form method="post" action="validacion_saneamiento.php">
    Nombre: <input type="text" name="nombre" required><br/>
    Email: <input type="email" name="email" required><br/><br/>
    <input type="submit" value="Enviar">
</form>

</body>
</html>
