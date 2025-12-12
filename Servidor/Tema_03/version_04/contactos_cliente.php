<?php
require_once 'init.php';
require_once 'session_check.php';
require_once 'Contactos.php';
require_once 'Clientes.php';

// Si quieres que SOLO admin pueda verlo, descomenta:
// if (!esAdmin()) redirigirConMensaje('dashboard.php', 'Acceso restringido a administradores.');

$idCliente = $_GET['idCliente'] ?? null;
if (!$idCliente || !is_numeric($idCliente)) {
    redirigirConMensaje('gestion_clientes.php', 'ID de cliente no válido.');
}

$clienteModel = new Cliente();
$cliente = $clienteModel->obtenerPorId((int)$idCliente);
if (!$cliente) {
    redirigirConMensaje('gestion_clientes.php', 'Cliente no existe.');
}

$model = new Contacto();
$lista = $model->obtenerPorCliente((int)$idCliente);

$mensaje = $_SESSION['mensaje'] ?? '';
unset($_SESSION['mensaje']);
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Contactos del cliente</title>
</head>
<body>

<h2>Contactos de: <?= htmlspecialchars($cliente['nombre'].' '.$cliente['apellidos'], ENT_QUOTES, 'UTF-8') ?></h2>

<?php if ($mensaje): ?>
  <p style="color:green"><?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>

<p>
  <a href="formulario_contacto.php?idCliente=<?= (int)$cliente['id'] ?>">+ Nuevo contacto para este cliente</a>
</p>

<table border="1" cellpadding="5" cellspacing="0">
  <tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Apellidos</th>
    <th>Email</th>
    <th>Teléfono</th>
    <th>Acciones</th>
  </tr>

  <?php foreach ($lista as $c): ?>
    <tr>
      <td><?= (int)$c['id'] ?></td>
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

<p>
  <a href="gestion_clientes.php">← Volver a clientes</a> |
  <a href="lista_contactos.php">Ver listado global</a>
</p>

</body>
</html>
