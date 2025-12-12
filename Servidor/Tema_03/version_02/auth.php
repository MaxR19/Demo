<?php
/*
El archivo auth.php es el cerebro del login.
Su misión es:
Recoger los datos enviados desde login.php.
Conectarse a la base de datos.
Comprobar si el usuario existe.
Verificar si la contraseña es correcta.
Crear la sesión del usuario.
Redirigirlo al panel (dashboard.php) o devolverlo al login si falla.
*/

session_start();

/*
session_start() activa las variables de sesión.
Necesario porque este archivo guardará variables como:
$_SESSION['usuario']
$_SESSION['rol']
Estas variables permitirán que el resto de páginas sepan quién está logueado.
*/

require_once 'db.php';

/*
Carga del archivo que conecta a la base de datos
Esto permite usar la función conectarDB():
Sin esto, auth.php no podría consultar la tabla usuarios.
*/

$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

/*
Recoger datos del formulario
Esto recoge los valores enviados desde login.php mediante POST.
Si el usuario no ha escrito nada, se asigna una cadena vacía ('').
Así se evitan errores por variables inexistentes.
*/

try {
    $db = conectarDB();
    $stmt = $db->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
    $stmt->execute([':usuario' => $usuario]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    /*
    Preparar y ejecutar consulta SQL:
    ¿Qué hace esto?
    Busca en la tabla usuarios una fila donde el campo usuario coincida.
    Si existe → devuelve un array asociativo:
    Si NO existe → $user será false.
    */

    if ($user && $user['password'] === $password) {

        /*
        Verificación de credenciales:
        1. Que el usuario exista ($user)
        2. Que la contraseña coincida
        En tu ejemplo las contraseñas están en texto plano, por eso se compara así:
        */

        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['rol'] = $user['rol'];

        /*
        Crear variables de sesión cuando el login ES correcto:
        Con esto conseguimos que:
        El nombre del usuario esté disponible en cualquier página.
        El rol determine si puede entrar o no a admin.php.
        */

        $_SESSION['mensaje'] = "Bienvenido, {$user['usuario']}";

        /*
        Guardar mensaje de bienvenida
        Esto permite que dashboard.php pueda mostrarlo si se desea.
        */

        header("Location: dashboard.php");
        exit;

        /*
        Redirigir al panel privado
        El usuario autenticado ya puede acceder a su panel.
        */

    } else {
        $_SESSION['mensaje'] = "Usuario o contraseña incorrectos";
        header("Location: login.php");
        exit;

        /*
        Cuando el login es incorrecto
        El usuario regresa a login.php, donde se mostrará el mensaje.
        */
    }

} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

/*
Manejo de errores de base de datos
Si algo falla (archivo mal conectado, tabla inexistente, etc.), aparece el error en 
pantalla.
*/