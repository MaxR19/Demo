<?php
require_once 'init.php';
require_once 'Usuarios.php';
require_once 'Roles.php';

// Solo los administradores pueden acceder
if (!esAdmin()) {
    redirigirConMensaje('dashboard.php', 'Acceso restringido a administradores.');
}

$usuario = new Usuario();
$rol = new Rol();

$listaUsuarios = $usuario->obtenerTodos();
$rolesDisponibles = $rol->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Zona de Administración</title>
</head>
<body>

<h2>Zona de Administración</h2>

<?php if (isset($_SESSION['mensaje'])): ?>
    <p style="color:green"><?= htmlspecialchars($_SESSION['mensaje']) ?></p>
    <?php unset($_SESSION['mensaje']); ?>
<?php endif; ?>

<!-- Tabla de usuarios -->
<h3>Usuarios registrados</h3>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Rol</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($listaUsuarios as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['usuario']) ?></td>
            <td><?= htmlspecialchars($u['rol']) ?></td>
            <td>
                <?php if ($_SESSION['usuario'] !== $u['usuario']): ?>
                    <a href="eliminar_user.php?id=<?= $u['id'] ?>"
                       onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</a>
                <?php else: ?>
                    (tú)
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<!-- Formulario de creación de nuevo usuario -->
<h3>Crear nuevo usuario</h3>
<form method="post" action="registrar_admin.php">
    <label>Usuario:</label><br>
    <input type="text" name="usuario" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Contraseña:</label><br>
    <input type="password" name="password" required><br><br>

    <label>Rol:</label><br>
    <select name="idRol" required>
        <?php foreach ($rolesDisponibles as $r): ?>
            <option value="<?= $r['idRol'] ?>"><?= htmlspecialchars($r['descripcion']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Crear usuario</button>
</form>

<p><a href="gestion_clientes.php">Gestión de clientes</a></p>
<p><a href="dashboard.php">Volver al panel</a></p>

</body>
</html>
