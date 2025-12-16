<?php
require_once 'validacion_usuario.php';

$cliente = new Cliente();
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : null;
$datosCliente = $id ? $cliente->obtenerClientePorCampo('id', $id) : null;

if ($id && !$datosCliente) cambiardePagina('gestion_clientes.php', 'Cliente no existe.');

?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Formulario de cliente</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
  <!-- Formulario de creación/edición de cliente -->
  <h2><?= $id ? 'Editar' : 'Nuevo' ?> cliente</h2>

  <?php if ($mensaje): ?>
    <p style="color:red"><?= htmlspecialchars($mensaje) ?></p>
  <?php endif; ?>

  <form method="post" action="guardar_cliente.php">
    <input type="hidden" name="id" value="<?= $id ? (int)$id : '' ?>">

    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="<?= $datosCliente ? htmlspecialchars($datosCliente->getNombre() ?? '') : '' ?>" required ><br><br>

    <label>Apellidos:</label><br>
    <input type="text" name="apellidos" value="<?= $datosCliente ? htmlspecialchars($datosCliente->getApellidos() ?? '') : '' ?>" required><br><br>

    <label>Edad:</label><br>
    <input type="number" name="edad" min="0" max="120" value="<?= $datosCliente ? htmlspecialchars((string)($datosCliente->getEdad() ?? '')) : '' ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= $datosCliente ? htmlspecialchars($datosCliente->getEmail() ?? '') : '' ?>" required><br><br>

    <label>Documento:</label><br>
    <input type="text" name="documento" value="<?= $datosCliente ? htmlspecialchars($datosCliente->getDocumento() ?? '') : '' ?>" required><br><br>

    <button type="submit"><?= $id ? 'Guardar cambios' : 'Crear cliente' ?></button>
  </form>

<p><a href="gestion_clientes.php">Volver</a></p>
</body>
</html>