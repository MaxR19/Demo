<?php

/*
Finalidad del archivo
Si el usuario ya ha iniciado sesión, lo redirige al panel (dashboard.php).
Si no ha iniciado sesión, le ofrece dos opciones: iniciar sesión (login) o registrarse.
*/

// Incluimos el archivo de inicialización
require_once 'init.php';

// Si el usuario ya está autenticado, lo llevamos al dashboard
if (estaLogueado()) {
    header("Location: dashboard.php");
    exit;
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

    <h1>Bienvenido al Sistema de Gestión de Usuarios</h1>
    <p>Por favor, elige una opción:</p>

    <!-- Mostrar mensaje si lo hubiera (por ejemplo, "Sesión cerrada correctamente") -->
    <?php if (isset($_SESSION['mensaje'])): ?>
        <p style="color:green"><?= htmlspecialchars($_SESSION['mensaje']) ?></p>
        <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>

    <!-- Dos formularios con botones: uno para login.php y otro para registro.php. Se usa 
    método GET. -->
    <form method="get" action="login.php" style="display:inline-block; margin-right:10px;">
        <button type="submit">Iniciar sesión</button>
    </form>

    <form method="get" action="registro.php" style="display:inline-block;">
        <button type="submit">Registrarse</button>
    </form>

</body>
</html>

<!-- 
Buenas prácticas aplicadas:
Se evita mostrar el formulario si ya hay sesión iniciada.
Se escapan los datos de salida (htmlspecialchars()) para evitar XSS.
Los botones usan formularios HTML simples para una navegación clara y accesible.
-->