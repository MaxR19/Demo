<?php
require_once 'init.php';
require_once 'validacion_usuario.php';
require_once './clases/Clientes.php';

if (!esAdmin()) redirigirConMensaje('dashboard.php', 'Acceso restringido a administradores.');

$model = new Cliente();
$lista = $model->obtenerTodos();

$mensaje = $_SESSION['mensaje'] ?? '';
unset($_SESSION['mensaje']);
?>
<!doctype html>
  <html lang="es">
  <head>
    <meta charset="utf-8"><title>Clientes</title>
    <link rel="stylesheet" href="estilos.css">
  </head>
  <body>
  <h2>Gestión de clientes</h2>

  <?php if ($mensaje): ?>
    <p style="color:green"><?= htmlspecialchars($mensaje) ?></p>
  <?php endif; ?>

  <p><a href="formulario_clientes.php">Nuevo cliente</a></p>

  <table border="1" cellpadding="5" cellspacing="0">
    <tr>
      <th>ID</th><th>Nombre</th><th>Apellidos</th><th>Edad</th><th>Email</th><th>Documento</th><th>Acciones</th>
    </tr>
    <?php foreach ($lista as $c): ?>
      <tr>
        <td><?= (int)$c['id'] ?></td>
        <td><?= htmlspecialchars($c['nombre'])?></td>
        <td><?= htmlspecialchars($c['apellidos']) ?></td>
        <td><?= (int)$c['edad'] ?></td>
        <td><?= htmlspecialchars($c['email']) ?></td>
        <td><?= htmlspecialchars($c['documento']) ?></td>
        <td>
          <a href="gestion_contactos.php?id=<?= (int)$c['id'] ?>">Ver contactos</a> |
          <a href="formulario_clientes.php?id=<?= (int)$c['id'] ?>">Editar</a> |
          <a href="eliminar_cliente.php?id=<?= (int)$c['id'] ?>"
            onclick="return confirm('¿Eliminar cliente?');">Eliminar</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>

  <p><a href="admin.php">Volver</a></p>
  </body>
</html>