<?php

// Función para validar el DNI con regex
/* function validarDNI($dni) {
    $patron = '/^[0-9]{8}[A-Z]{1}$/';
    return preg_match($patron, $dni);
} */

function validar($valor) {
    $valor = trim($valor);

    // Definición de patrones fuera de preg_match()
    $patron_dni = '/^[0-9]{8}[A-Z]{1}$/';
    // $patron_nombre = '/^[A-Za-zÁÉÍÓÚÜáéíóúüÑñ\s]{2,}$/u';
    $patron_nombre ='/^[A-Za-z]+$/';

    // Validación con los patrones
    if (preg_match($patron_dni, $valor)) {
        return true;
    }

    if (preg_match($patron_nombre, $valor)) {
        return true;
    }

    return false;
}

// Si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];

    if (!empty($nombre) && !empty($apellidos) && validar($nombre) && validar($apellidos)) {

        echo "Hola, " . $_POST['nombre'] . " " . $_POST['apellidos'] . "<br/>"; 

        $dni = $_POST['dni'];

        if (validar($dni)) {
            echo "Tu DNI " . htmlspecialchars($dni) . " es válido.<br/>";
        } else {
            echo "Tu DNI " . htmlspecialchars($dni) . " no tiene un formato válido.<br/>";
        }
    } else {
        echo "Debes introducir el DNI para poderlo validar"; 
    }

    echo '<br><a href="dni_validacion.php">Volver</a>';
    exit;
}

/* <?php 
    if (!empty($_POST['nombre']) && !empty($_POST['apellidos']) && !empty($_POST['dni'])) { 
        echo "Hola, " . $_POST['nombre'] . " " . $_POST['apellidos'] . "<br/>"; 
        $dni = $_POST['dni']; 
        $patron = '/^[09]{8}[A-Z]{1}$/'; 
        
        if (preg_match($patron, $dni)) { 
            echo "Tu DNI $dni es válido"; 
        } else { 
            echo "Tu DNI $dni no tiene un formato válido";
        } 
    } else {
        echo "Debes introducir el DNI para poderlo validar"; 
    } 
?> */



?>

<!DOCTYPE html>
<html>
<head>
    <title>Validación de DNI</title>
</head>
<body>

<h2>Introduce tus datos</h2>
<form method="post" action="dni_validacion.php">
    Nombre: <input type="text" name="nombre"/><br/> 
    Apellidos: <input type="text" name="apellidos"/><br/> 
    DNI: <input type="text" name="dni" maxlength="9" required/><br/><br/>
    <input type="submit" value="Validar"/>
</form>

</body>
</html>
