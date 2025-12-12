<?php
/* Este archivo actúa como una “puerta de entrada” que, según el enlace que pulse el usuario, 
lo redirige a una página distinta. Al principio del script PHP se comprueba si en la URL viene 
el parámetro parametro (por ejemplo, Ejemplo_01.php?parametro=valor1). Si existe, se guarda su 
contenido en la variable $valor (sanitizado con htmlspecialchars) y se entra en un switch. En 
ese switch, para cada posible valor (valor1, valor2, valor3) se llama a header('Location: 
paginaX.php') y luego a exit; lo que envía una cabecera HTTP de redirección y detiene la 
ejecución del script, llevando al usuario a pagina1.php, pagina2.php o pagina3.php según corresponda.

Si el parámetro parametro no viene en la URL (por ejemplo, la primera vez que se abre el archivo), no se hace ninguna redirección y se sigue la ejecución normal hasta la parte HTML. En el <body> se muestran tres enlaces que apuntan de nuevo a este mismo archivo (Ejemplo_01.php), pero añadiendo ?parametro=valor1, ?parametro=valor2 o ?parametro=valor3. Al hacer clic en cualquiera de ellos, la página se recarga con el parámetro adecuado y, gracias al switch, el usuario es enviado automáticamente a la página correspondiente.
*/

if (isset($_GET['parametro'])) {
    $valor = htmlspecialchars($_GET['parametro']); // Sanitiza para evitar XSS
    
    switch($valor) {
    case 'valor1':
        header('Location: pagina1.php');
        exit;
    case 'valor2':
        header('Location: pagina2.php');
        exit;
    case 'valor3':
        header('Location: pagina3.php');
        exit;
    default:
        echo "Parámetro no reconocido.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Enlace con parámetro</title>
</head>
<body>
    <!-- Enlaces que envían un parámetro "parametro=valor" a la misma página php -->
    <!--
    <a href="Ejemplo_01.php?parametro=valor1">Ir a la página valor1</a>
    <a href="Ejemplo_01.php?parametro=valor2">Ir a la página valor2</a>
    <a href="Ejemplo_01.php?parametro=valor3">Ir a la página valor3</a>
    -->
    <form action="Ejemplo_01.php" method="get">
        <button type="submit" name="parametro" value="valor1">Ir a la página valor1</button>
        <button type="submit" name="parametro" value="valor2">Ir a la página valor2</button>
        <button type="submit" name="parametro" value="valor3">Ir a la página valor3</button>
    </form>

</body>
</html>
