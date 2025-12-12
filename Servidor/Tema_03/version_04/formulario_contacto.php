<?php
require_once 'init.php';
require_once 'session_check.php';
require_once 'Contactos.php';
require_once 'Clientes.php';

// Si quieres que SOLO admin pueda verlo, descomenta:
// if (!esAdmin()) redirigirConMensaje('dashboard.php', 'Acceso restringido a administradores.');

$contactoModel = new Contacto();
$clienteModel  = new Cliente();

$clientes = $clienteModel->obtenerTodos();

$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : null;
$idCliente = isset($_GET['idCliente']) && is_numeric($_GET['idCliente']) ? (int)$_GET['idCliente'] : null;

$datos = $id ? $contactoModel->obtenerPorId($id) : null;

if ($id && !$datos) {
    redirigirConMensaje('contactos.php', 'El contacto no existe.');
}

// Si es nuevo y viene idCliente, lo preseleccionamos
$selectedCliente = $datos['idCliente'] ?? $idCliente ?? '';

$mensaje = $_SESSION['mensaje'] ?? '';
unset($_SESSION['mensaje']);
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title><?= $id ? 'Editar' : 'Nuevo' ?> contacto</title>
</head>
<body>

<h2><?= $id ? 'Editar' : 'Nuevo' ?> contacto</h2>

<?php if ($mensaje): ?>
  <p style="color:red"><?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>

<form method="post" action="guardar_contacto.php">
  <input type="hidden" name="id" value="<?= $id ? (int)$id : '' ?>">

  <label>Cliente:</label><br>
  <select name="idCliente" required>
    <option value="">-- Selecciona un cliente --</option>
    <?php foreach ($clientes as $cl): ?>
      <option value="<?= (int)$cl['id'] ?>"
        <?= ((string)$selectedCliente === (string)$cl['id']) ? 'selected' : '' ?>>
        <?= htmlspecialchars($cl['nombre'].' '.$cl['apellidos'], ENT_QUOTES, 'UTF-8') ?>
      </option>
    <?php endforeach; ?>
  </select>
  <br><br>

  <label>Nombre:</label><br>
  <input type="text" name="nombre" required
         value="<?= htmlspecialchars($datos['nombre'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
  <br><br>

  <label>Apellidos:</label><br>
  <input type="text" name="apellidos" required
         value="<?= htmlspecialchars($datos['apellidos'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
  <br><br>

  <label>Email:</label><br>
  <input type="email" name="email" required
         value="<?= htmlspecialchars($datos['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
  <br><br>

  <label>Teléfono (España):</label><br>
  <input type="text" name="telefono" required
         placeholder="Ej: 612345678 o +34 612 345 678"
         value="<?= htmlspecialchars($datos['telefono'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
  <br><br>

  <button type="submit"><?= $id ? 'Guardar cambios' : 'Crear contacto' ?></button>
</form>

<p>
  <a href="lista_contactos.php">← Volver al listado global</a>
  <?php if ($idCliente): ?>
    | <a href="contactos_cliente.php?idCliente=<?= (int)$idCliente ?>">Volver a contactos del cliente</a>
  <?php endif; ?>
</p>

</body>
</html>
