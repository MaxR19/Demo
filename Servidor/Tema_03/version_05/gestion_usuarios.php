<?php
require_once 'init.php';
require_once 'validacion_usuario.php';
require_once './clases/Usuarios.php';

if (!esAdmin()) redirigirConMensaje('dashboard.php', 'Acceso restringido a administradores.');

$usuario = new Usuario();

$listaUsuarios = $usuario->obtenerTodos();

$mensaje = $_SESSION['mensaje'] ?? '';
unset($_SESSION['mensaje']);
?>
<!doctype html>
<html lang="es">
<head><meta charset="utf-8"><title>Usuarios</title><link rel="stylesheet" href="estilos.css"></head>
<body>
<h2>Gestión de usuarios</h2>

<?php if ($mensaje): ?>
  <p style="color:green"><?= htmlspecialchars($mensaje) ?></p>
<?php endif; ?>

<p><a href="formulario_usuarios.php">Nuevo usuario</a></p>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Email</th>
        <th>Rol</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($listaUsuarios as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['usuario']) ?></td>
            <td><?= $u['email'] ?></td>
            <td><?= htmlspecialchars($u['rol']) ?></td>
            <td>
                <a href="formulario_usuarios.php?id=<?= (int)$u['id'] ?>">Editar</a> |
                <a href="eliminar_usuario.php?id=<?= $u['id'] ?>"
                    onclick="return confirm('¿Desea eliminar este usuario?');">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<p><a href="admin.php">Volver</a></p>
</body>
</html>