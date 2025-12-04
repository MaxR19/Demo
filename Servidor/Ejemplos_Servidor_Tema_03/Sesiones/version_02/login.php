<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = strip_tags(trim($_POST['nombre']));

    if (!empty($nombre)) {
        // Asignamos el rol automáticamente
        $rol = ($nombre === 'admin') ? 'admin' : 'invitado';

        // Guardamos datos en sesión
        $_SESSION['nombre'] = $nombre;
        $_SESSION['rol'] = $rol;

        // Guardamos al usuario en la "lista de registrados"
        if (!isset($_SESSION['usuarios'])) {
            $_SESSION['usuarios'] = [];
        }

        if (!in_array($nombre, $_SESSION['usuarios'])) {
            $_SESSION['usuarios'][] = $nombre;
        }

        header("Location: bienvenida.php");
        exit;
    } else {
        $error = "Por favor, introduce tu nombre.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Iniciar sesión</title>
</head>
<body>

<h2>Inicio de sesión</h2>

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="post" action="login.php">
    Nombre: <input type="text" name="nombre" required><br/><br/>
    <input type="submit" value="Entrar">
</form>

</body>
</html>
