<?php
require_once 'validacion_usuario.php';

// Manejamos redirecciones basadas en el parámetro 'pagina' que se recibe por el método GET
if (isset($_GET['pagina'])) {
    // Sanitizar para evitar XSS
    $valor = htmlspecialchars($_GET['pagina']); 

    switch($valor) {
        case 'usuarios':
            cambiardePagina('gestion_usuarios.php', '');
            break;
        case 'clientes':
            cambiardePagina('gestion_clientes.php', '');
            break;
        case 'contactos':
            cambiardePagina('gestion_contactos.php', '');
            break;
        default:
            cambiardePagina('admin.php', 'Opción no válida.');
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h2>Panel de Administración</h2>

    <?php if (isset($_SESSION['mensaje'])): ?>
        <p style="color:green"><?= htmlspecialchars($_SESSION['mensaje']) ?></p>
        <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>

    <!-- Un formulario con dos botones: uno para login.php y otro para registro.php. Se usa el
    método GET para redireccionar al usuario. -->
    <form method="get" action="admin.php" style="display:inline-block; margin-right:10px;">
        <button type="submit" name="pagina" value="usuarios">Usuarios</button>
        <button type="submit" name="pagina" value="clientes">Clientes</button>
        <button type="submit" name="pagina" value="contactos">Contactos</button>
        <a href="cerrar_sesion.php">Cerrar sesión</a>
    </form>
</body>
</html>