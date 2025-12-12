<?php
session_start();
session_unset();
session_destroy();
setcookie('recordar_usuario', '', time() - 3600, "/"); // Eliminar cookie
header("Location: login.php");
exit;
