<?php
// Finalidad del archivo: Ofrecer dos opciones al usuario: iniciar sesión o registrarse.

// Incluimos el archivo de arranque de la aplicación
require_once 'init.php';

// Manejamos redirecciones basadas en el parámetro 'pagina' que se recibe por el método GET
if (isset($_GET['pagina'])) {
    // Sanitizar para evitar XSS
    $valor = htmlspecialchars($_GET['pagina']); 

    if ($valor === 'login') {
        cambiardePagina('login.php', '');
    } elseif ($valor === 'registro') {
        cambiardePagina('registro.php', '');
    } else {
        cambiardePagina('index.php', 'Opción no válida.');
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Bienvenido</h1>
    <!-- Mostrar mensaje si lo hubiera (por ejemplo, "Sesión cerrada correctamente") -->
    <?php if (isset($_SESSION['mensaje'])): ?>
        <p style="color:red"><?= htmlspecialchars($_SESSION['mensaje']) ?></p>
        <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>

    <!-- Un formulario con dos botones: uno para login.php y otro para registro.php. Se usa el
    método GET para redireccionar al usuario. -->
    <form method="get" action="index.php" style="display:inline-block; margin-right:10px;">
        <button type="submit" name="pagina" value="login">Iniciar sesión</button>
        <button type="submit" name="pagina" value="registro">Registrarse</button>
    </form>
</body>
</html>

<!-- 
Buenas prácticas aplicadas:
Se evita mostrar el formulario si ya hay sesión iniciada.
Se escapan los datos de salida (htmlspecialchars()) para evitar XSS.
Los botones usan formularios HTML simples para una navegación clara y accesible.
-->