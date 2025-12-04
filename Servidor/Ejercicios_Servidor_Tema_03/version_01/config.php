<?php
//Siempre es interesante en todo tipo de proyectos tener un fichero de configuracion 
//con las conexiones y parametrizaciones del sistema


// Los ajustes están definidos dentro de un array
return [
    // Configuración de la base de datos
    'database' => [
        'dbname'   => 'usuarios.db',
    ],

    // Define que la base de datos usada es un archivo SQLite llamado usuarios.db.

    // Configuración general de la aplicación
    'app' => [
        'name'      => 'Gestion de usuarios',
        'version'   => '1.0.0',
        'debug'     => true,
        'timezone'  => 'Europe/Madrid',
    ],

    // Configuración general:
    // Nombre de la app.
    // Versión.
    // Modo debug (true).
    // Zona horaria (Europe/Madrid).

    //DURACION SESION 
    'sesion' => [
        'duracion_seg' => '3600', //esta en segundos
    ],

    // La sesión dura 3600 segundos (1 hora).

    'pass' => [
        'hash' => PASSWORD_DEFAULT, //esta en segundos
    ],

    // Clave secreta para hashing de contraseñas u otra lógica criptográfica.
];
