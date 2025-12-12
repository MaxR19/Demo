<?php
require_once 'init.php';
require_once 'session_check.php';
require_once 'Contactos.php';

// Si quieres que SOLO admin pueda verlo, descomenta:
// if (!esAdmin()) redirigirConMensaje('dashboard.php', 'Acceso restringido a administradores.');

$model = new Contacto();
$lista = $model->obtenerTodos();

$mensaje = $_SESSION['mensaje'] ?? '';
unset($_SESSION['mensaje']);
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Contactos (Todos)</title>
</head>
<body>

<h2>Listado global de contactos</h2>

<?php if ($mensaje): ?>
  <p style="color:green"><?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>

<p><a href="formulario_contacto.php">+ Nuevo contacto</a></p>

<table border="1" cellpadding="5" cellspacing="0">
  <tr>
    <th>ID</th>
    <th>Cliente</th>
    <th>Nombre</th>
    <th>Apellidos</th>
    <th>Email</th>
    <th>Teléfono</th>
    <th>Acciones</th>
  </tr>

  <?php foreach ($lista as $c): ?>
    <tr>
      <td><?= (int)$c['id'] ?></td>
      <td><?= htmlspecialchars($c['cliente_nombre'] . ' ' . $c['cliente_apellidos'], ENT_QUOTES, 'UTF-8') ?></td>
      <td><?= htmlspecialchars($c['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
      <td><?= htmlspecialchars($c['apellidos'], ENT_QUOTES, 'UTF-8') ?></td>
      <td><?= htmlspecialchars($c['email'], ENT_QUOTES, 'UTF-8') ?></td>
      <td><?= htmlspecialchars($c['telefono'], ENT_QUOTES, 'UTF-8') ?></td>
      <td>
        <a href="formulario_contacto.php?id=<?= (int)$c['id'] ?>">Editar</a> |
        <a href="eliminar_contacto.php?id=<?= (int)$c['id'] ?>"
           onclick="return confirm('¿Eliminar contacto?');">Eliminar</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<p><a href="dashboard.php">← Volver</a></p>

</body>
</html>
