<?php
session_start();

// Redirige si no hay sesión activa
if (!isset($_SESSION['nombre']) || !isset($_SESSION['rol'])) {
    header("Location: login.php");
    exit;
}

$nombre = htmlspecialchars($_SESSION['nombre']);
$rol = $_SESSION['rol'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Zona privada</title>
</head>
<body>

<h2>Bienvenido, <?= $nombre ?> 👋</h2>
<p>Tu rol: <strong><?= ucfirst($rol) ?></strong></p>

<?php if ($rol === 'admin'): ?>
    <h3>Listado de usuarios registrados:</h3>
    <ul>
        <?php
        foreach ($_SESSION['usuarios'] as $usuario) {
            echo "<li>" . htmlspecialchars($usuario) . "</li>";
        }
        ?>
    </ul>
<?php else: ?>
    <h3>Zona de usuario</h3>
    <p>Este es tu perfil personal.</p>
<?php endif; ?>

<br/>
<a href="cerrar.php">Cerrar sesión</a>

</body>
</html>
