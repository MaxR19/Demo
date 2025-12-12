<?php
session_start();

$usuarios = require 'usuarios.php';

$user = $_POST['usuario'] ?? '';
$pass = $_POST['password'] ?? '';

if (isset($usuarios[$user]) && $usuarios[$user]['password'] === $pass) {
    $_SESSION['usuario'] = $user;
    $_SESSION['rol'] = $usuarios[$user]['rol'];

    $_SESSION['mensaje'] = "Bienvenido, $user";
    header("Location: dashboard.php");
    exit;
} else {
    $_SESSION['mensaje'] = "Usuario o contraseña incorrectos";
    header("Location: login.php");
    exit;
}
