<?php
require_once 'init.php';
require_once 'session_check.php';
require_once 'Clientes.php';

// if (!esAdmin()) redirigirConMensaje('dashboard.php', 'Acceso restringido a administradores.');

$model = new Cliente();
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : null;
$datos = $id ? $model->obtenerPorId($id) : null;

if ($id && !$datos) redirigirConMensaje('gestion_clientes.php', 'Cliente no existe.');

$mensaje = $_SESSION['mensaje'] ?? '';
unset($_SESSION['mensaje']);
?>
<!doctype html>
<html lang="es">
<head><meta charset="utf-8"><title><?= $id ? 'Editar' : 'Nuevo' ?> Cliente</title></head>
<body>
<h2><?= $id ? 'Editar' : 'Nuevo' ?> cliente</h2>

<?php if ($mensaje): ?>
  <p style="color:red"><?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>

<form method="post" action="guardar_cliente.php">
  <input type="hidden" name="id" value="<?= $id ? (int)$id : '' ?>">

  <label>Nombre:</label><br>
  <input type="text" name="nombre" required value="<?= htmlspecialchars($datos['nombre'] ?? '', ENT_QUOTES, 'UTF-8') ?>"><br><br>

  <label>Apellidos:</label><br>
  <input type="text" name="apellidos" required value="<?= htmlspecialchars($datos['apellidos'] ?? '', ENT_QUOTES, 'UTF-8') ?>"><br><br>

  <label>Edad:</label><br>
  <input type="number" name="edad" required min="0" max="120" value="<?= htmlspecialchars((string)($datos['edad'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"><br><br>

  <label>Email:</label><br>
  <input type="email" name="email" required value="<?= htmlspecialchars($datos['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>"><br><br>

  <label>Documento:</label><br>
  <input type="text" name="documento" required
         value="<?= htmlspecialchars($datos['documento'] ?? '', ENT_QUOTES, 'UTF-8') ?>"><br><br>

  <button type="submit"><?= $id ? 'Guardar cambios' : 'Crear cliente' ?></button>
</form>

<p><a href="gestion_clientes.php">Volver a la lista</a></p>
</body>
</html>
