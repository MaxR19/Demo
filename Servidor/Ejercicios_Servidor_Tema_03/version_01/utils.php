<?php
//Importo mi fichero de configuracion 
$config=require_once "config.php";

//Incluyo mi libreria de encriptacion
require_once "encriptador.php";

//Incluyo mi control de errores
require_once "error.php";

//Incluyo mi sanetizacion
require_once "sanetizar.php";

//Incluyo mi gestion de la sesion 
require_once "sesion.php";

//Me traigo la bbdd y la instancio para poder usarla
require_once "db.php";
$db = new BaseDatos();
$pdo = $db->getPdo();