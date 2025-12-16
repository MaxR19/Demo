<?php 
require_once 'validacion_usuario.php';

$contacto = new Contacto();

// id del cliente recogido en la página de gestión de clientes
$idCliente = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : null;

// Si viene id de cliente → solo contactos de ese cliente
// Si no viene → lista completa de contactos
$listadoContactos = $idCliente
    ? $contacto->obtenerContactosPorCliente($idCliente)
    : $contacto->obtenerContactos();

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Contactos del cliente</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
<h2>Contactos<?= $idCliente ? " del cliente #$idCliente" : '' ?></h2>

<?php if ($mensaje): ?>
  <p style="color:green"><?= htmlspecialchars($mensaje) ?></p>
<?php endif; ?>

<p>
  <a href="formulario_contactos.php<?= $idCliente ? '?idCliente='.(int)$idCliente : '' ?>">
    + Nuevo contacto
  </a>
</p>

<table border="1" cellpadding="5" cellspacing="0">
  <tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Apellidos</th>
    <th>Email</th>
    <th>Teléfono</th>
    <th>ID Cliente</th>
    <th>Acciones</th>
  </tr>

  <?php if (empty($listadoContactos)): ?>
    <tr>
      <td colspan="6">Sin resultados.</td>
    </tr>
  <?php else: ?>
    <?php foreach ($listadoContactos as $c): ?>
      <tr>
        <td><?= (int)$c['id'] ?></td>
        <td><?= htmlspecialchars($c['nombre']) ?></td>
        <td><?= htmlspecialchars($c['apellidos']) ?></td>
        <td><?= htmlspecialchars($c['email']) ?></td>
        <td><?= htmlspecialchars($c['numTelefono']) ?></td>
        <td>
          <a href="formulario_contactos.php?id=<?= (int)$c['id'] ?><?= $idCliente ? '&idCliente='.(int)$idCliente : '' ?>">Editar</a>
          <a href="eliminar_contacto.php?id=<?= (int)$c['id'] ?>"
             onclick="return confirm('¿Eliminar contacto?');">Eliminar</a>
        </td>
      </tr>
    <?php endforeach; ?>
  <?php endif; ?>
</table>

<p><a href="gestion_clientes.php">Volver</a></p>
</body>
</html>
