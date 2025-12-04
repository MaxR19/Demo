function IrFicha(list = false) {
     //Controlo que la llamada venga o no de la lista para gestionar la vuelta
    let qList = "";
    if (list) {
        qList = "?listado=true";
    }
    let frm = document.forms[0];
    frm.action = `ficha.php${qList}`;
    frm.submit();
}

/*
Qué hace:

- Redirige el formulario a ficha.php.
- Si el parámetro list es true, agrega ?listado=true a la URL (para saber que se vino desde una lista).
- Envía el formulario.

📌 Uso típico: acceder a un formulario para crear un nuevo usuario.
*/

function IrLogin() {
    let frm = document.forms[0];
    frm.action = `login.php`;
    frm.submit();
}

/*
Qué hace:
- Redirige el formulario a login.php.
- Envía el formulario.

📌 Uso típico: ir al formulario de login.
*/


function anadirUsuario(list = false) {
    //Controlo que la llamada venga o no de la lista para gestionar la vuelta
    let qList = "";
    if (list) {
        qList = "&listado=true";
    }
    let frm = document.forms[0];
    frm.action = `ficha_guardar.php?action=anadir${qList}`;
    frm.submit();
}

/*
Qué hace:
- Redirige el formulario a ficha_guardar.php con action=anadir (para agregar usuario).
- Si list = true, agrega &listado=true para saber que viene desde la lista.
- Envía el formulario.
*/

function modificarUsuario(list = false) {
    //Controlo que la llamada venga o no de la lista para gestionar la vuelta
    let qList = "";
    if (list) {
        qList = "&listado=true";
    }

    let frm = document.forms[0];
    frm.action = `ficha_guardar.php?action=guardar${qList}`;
    frm.submit();
}

/*
Qué hace:
- Redirige el formulario a ficha_guardar.php con action=guardar (para actualizar usuario existente).
- Si viene de una lista, añade &listado=true.
- Envía el formulario.
*/

function login() {
    let frm = document.forms[0];
    frm.action = `acceder.php?action=login`;
    frm.submit();
}

/*
Qué hace:
- Redirige a acceder.php?action=login, que seguramente valida las credenciales.
- Envía el formulario.
*/

function eliminarUsuario(id) {
    //Me hago una funcion de javascript para lanzar el submit del form oculto 
    let url = 'ficha_guardar.php?action=eliminar&listado=true';
    let conf = confirm(`¿Seguro que deseas eliminar este usuario, con id ${id}?`);

    let hid = document.getElementById('usuario_id');
    hid.value = id;

    if (conf) {
        let frm = document.forms[0];
        frm.action = url;
        frm.submit()
    }
}

/*
Qué hace:
- Muestra un confirm() para confirmar si se desea eliminar al usuario con el ID indicado.

Si el usuario acepta:
- Asigna ese ID a un campo oculto (<input type="hidden" id="usuario_id">) para enviarlo al backend.
- Redirige el formulario a ficha_guardar.php?action=eliminar&listado=true.
- Envía el formulario.

📌 Nota: el campo oculto usuario_id debe estar en el formulario HTML, si no, fallará.
*/