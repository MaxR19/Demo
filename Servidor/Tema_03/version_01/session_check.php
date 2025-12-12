<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    $_SESSION['mensaje'] = "Debes iniciar sesión para acceder.";
    header("Location: login.php");
    exit;
}
