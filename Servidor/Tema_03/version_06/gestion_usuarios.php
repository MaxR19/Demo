<?php
require_once 'validacion_usuario.php';

$usuario = new Usuario();
$listadoUsuarios = $usuario->obtenerUsuarios();

// Manejamos redirecciones basadas en el parámetro 'pagina' que se recibe por el método GET
if (isset($_GET['pagina'])) {
    // Sanitizar para evitar XSS
    $valor = htmlspecialchars($_GET['pagina']); 

    if ($valor === 'formulario') {
        cambiardePagina('formulario_usuarios.php', '');
    } elseif ($valor === 'admin') {
        cambiardePagina('admin.php', '');
    } else {
        cambiardePagina('gestion_usuarios.php', 'Opción no válida.');
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head><meta charset="utf-8"><title>Usuarios</title>
<link rel="stylesheet" href="estilos.css"></head>
<body>
    <h2>Gestión de usuarios</h2>

    <?php if ($mensaje): ?>
    <p style="color:green"><?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>

    <!-- Un formulario con dos botones: uno para login.php y otro para registro.php. Se usa el
    método GET para redireccionar al usuario. -->
    <form method="get" action="gestion_usuarios.php" style="display:inline-block; margin-right:10px;">
        <button type="submit" name="pagina" value="formulario">+ Nuevo usuario</button>
        <button type="submit" name="pagina" value="admin">Volver</button>
    </form>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Email</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>

        <?php if (empty($listadoUsuarios)): ?>
            <tr>
                <td colspan="7">Sin resultados</td>
            </tr>
        <?php else: ?>
            <?php foreach ($listadoUsuarios as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= htmlspecialchars($u['usuario']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= htmlspecialchars($u['nombre']) ?></td>
                    <td><?= htmlspecialchars($u['apellidos']) ?></td>
                    <td><?= htmlspecialchars($u['rol']) ?></td>
                    <td>
                        <a href="formulario_usuarios.php?id=<?= (int)$u['id'] ?>">Editar</a>
                        <a href="eliminar_usuario.php?id=<?= $u['id'] ?>"
                        onclick="return confirm('¿Desea eliminar este usuario?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>
</html>