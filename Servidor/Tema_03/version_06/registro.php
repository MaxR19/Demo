<?php

/*
Objetivo de registro.php
Este archivo:
Muestra el formulario público para que cualquier visitante pueda registrarse.
Registra a los nuevos usuarios como rol "usuario" automáticamente (esto lo gestiona 
registrar_action.php).
Muestra mensajes de error o confirmación usando $_SESSION['mensaje'].
*/

require_once 'init.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<h2>Registrarse como nuevo usuario</h2>

<?php if (isset($_SESSION['mensaje'])): ?>
    <p style="color:red"><?= htmlspecialchars($_SESSION['mensaje']) ?></p>
    <?php unset($_SESSION['mensaje']); ?>
<?php endif; ?>

<form method="post" action="guardar_usuario.php">
    <label for="usuario">Usuario:</label><br>
    <input type="text" name="usuario" id="usuario" required
           title="Debe tener entre 3 y 20 caracteres."><br><br>

    <label for="password">Contraseña:</label><br>
    <input type="password" name="password" id="password" required minlength="6"><br><br>

    <label for="email">Email:</label><br>
    <input type="email" name="email" id="email" required><br><br>

    

    <button type="submit">Registrar</button>
</form>

<p><a href="index.php">Volver al inicio</a></p>

</body>
</html>