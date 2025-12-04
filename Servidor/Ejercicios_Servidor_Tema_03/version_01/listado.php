<?php
require_once "./models/Usuarios.php";
require_once "./models/Roles.php";
//Me traigo el fichero que tiene todas las librerias básicas del proyecto
require_once "utils.php";

$usu = new Usuario();
$rol = new Rol();

$usuarios = $usu->obtenerTodos($pdo);
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Listado de Usuarios</title>

    <link rel="stylesheet" href="./estilos/estilos.css">

    <script src="./scripts/scripts.js"></script>
</head>

<body>
    <div class="tabla-contenedor">

        <h1>Listado de Usuarios</h1>

        <a href="#" onclick="javascript:IrFicha(true)" class="btn primary anadir">➕ Añadir Usuario</a>

        <table>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Email</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>

            <?php foreach ($usuarios as $u): ?>
            <tr>
                <td><?= $u->getId() ?></td>
                <td><?= $u->getUsuario() ?></td>
                <td><?= $u->getEmail() ?></td>
                <td><?= $u->getNombre() ?></td>
                <td><?= $u->getApellidos() ?></td>
                <td><?= $u->getRolId() == 1 ? 'Admin' : 'Usuario' ?>
                </td>

                <td class="acciones">
                    <a
                        href="ficha.php?usuario_id=<?= $u->getId() ?>">
                        <button class="btn editar">Editar</button>
                    </a>

                    <a href="#" onclick="javascript:eliminarUsuario(<?= $u->getId() ?>)">
                        <button class="btn borrar">Borrar</button>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>

        </table>
    </div>
    <form action="" method="post" id="frmEli" name="frmEli" style="visibility: hidden;">
        <input type="hidden" name="usuario_id" id="usuario_id">
    </form>
</body>

</html>