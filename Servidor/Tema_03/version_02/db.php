<?php

/*
¿Qué hace este archivo?
Define una función llamada conectarDB() que:
Crea una conexión a una base de datos SQLite.
Configura la conexión para que muestre excepciones en caso de error.
Devuelve el objeto PDO, que luego se usa para hacer consultas a la base de datos.
*/

function conectarDB() {
    $db = new PDO('sqlite:database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Devuelve el objeto de conexión a quien llame a conectarDB().
    return $db;
}

/*
Crea un nuevo objeto PDO que se conecta a una base de datos SQLite llamada 
database.db.
La base de datos debe estar en el mismo directorio que el archivo .php, o puedes 
poner una ruta absoluta o relativa diferente si está en otra ubicación.
*/
