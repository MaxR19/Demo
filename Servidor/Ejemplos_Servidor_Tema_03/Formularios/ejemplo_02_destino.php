<?php
// destino.php

// Verificamos si el parámetro 'parametro' existe en la URL
if (isset($_GET['parametro'])) {
    $valor = htmlspecialchars($_GET['parametro']); // Sanitiza para evitar XSS
    echo "El valor del parámetro es: " . $valor;
} else {
    echo "No se recibió ningún parámetro.";
}
?>
