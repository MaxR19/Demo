<?php
require_once 'init.php';
require_once 'session_check.php';
require_once 'Clientes.php';

if (!esAdmin()) redirigirConMensaje('dashboard.php', 'Acceso restringido a administradores.');

$model = new Cliente();
$lista = $model->obtenerTodos();

$mensaje = $_SESSION['mensaje'] ?? '';
unset($_SESSION['mensaje']);
?>
<!doctype html>
<html lang="es">
<head><meta charset="utf-8"><title>Clientes</title></head>
<body>
<h2>Gestión de clientes</h2>

<?php if ($mensaje): ?>
  <p style="color:green"><?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>

<p><a href="formulario_clientes.php">+ Nuevo cliente</a></p>

<table border="1" cellpadding="5" cellspacing="0">
  <tr>
    <th>ID</th><th>Nombre</th><th>Apellidos</th><th>Edad</th><th>Email</th><th>Documento</th>
    <th>Contactos</th>
    <th>Acciones</th>
  </tr>

  <?php foreach ($lista as $c): ?>
    <tr>
      <td><?= (int)$c['id'] ?></td>
      <td><?= htmlspecialchars($c['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
      <td><?= htmlspecialchars($c['apellidos'], ENT_QUOTES, 'UTF-8') ?></td>
      <td><?= (int)$c['edad'] ?></td>
      <td><?= htmlspecialchars($c['email'], ENT_QUOTES, 'UTF-8') ?></td>
      <td><?= htmlspecialchars($c['documento'], ENT_QUOTES, 'UTF-8') ?></td>

      <td>
        <a href="contactos_cliente.php?idCliente=<?= (int)$c['id'] ?>">Ver contactos</a>
      </td>

      <td>
        <a href="formulario_clientes.php?id=<?= (int)$c['id'] ?>">Editar</a> |
        <a href="eliminar_cliente.php?id=<?= (int)$c['id'] ?>"
           onclick="return confirm('¿Eliminar cliente? (se borrarán también sus contactos)');">Eliminar</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<p><a href="dashboard.php">← Volver</a></p>
</body>
</html>
