/*
Este archivo:
Hace una llamada a la API de Harry Potter.
Filtra personajes por casa.
Agrupa y ordena personajes por año de nacimiento.
Muestra sus imágenes, nombres, apodos y años
Si se hace clic en una imagen, guarda el personaje en localStorage 
y redirecciona a la página de detalles.
*/

/*
Hace una petición fetch a la URL
Devuelve los datos en formato JSON.
*/

// Llama a la API y obtiene todos los personajes.

async function llamadaAPI(url) {
    //LLAMO A LA API PARA QUE ME DEVUELVA EL CUERPO
    let cuerpo_respuesta = await fetch(url);
    
    //LLAMO A LOS DATOS DEL JSON
    let datos = await cuerpo_respuesta.json();

    return datos;
}

/*
Muestra todos los personajes de una casa concreta (si id está vacío).
Si se recibe un id, muestra solo un personaje (para la vista Articulo).
*/

// Filtra, agrupa y muestra los personajes en pantalla.


/*
2. Filtrado según casa o por ID
Si se pasa un id, buscas ese personaje exacto — útil en la vista de detalle (Articulo).
Si no hay id, filtras según la casa elegida.
Si la casa es "SinCasa", tomas los personajes que no pertenecen a ninguna de las casas oficiales.
Así tu misma función sirve para listado completo por casa y detalle individual.
*/


async function datosHarryPotter(casa, id = "") {

    //LLAMO A MI FUNCION PARA QUE ME EXTRAIGA TODOS LOS PERSONAJES DE LA API.
    const url = "https://hp-api.onrender.com/api/characters";
    let data = await llamadaAPI(url);
    //console.log("data", data);
    
    // ------------------------------------------------

    /*
    Si hay id, filtra por personaje.
    Si es "SinCasa", incluye los que no pertenecen a ninguna casa oficial.
    Si se especifica una casa, filtra por ella.
    */

    let oResult;
    if (id != "") {
        //Pinto ficha
        // Cuando se llama con un id, la parte del filtrado hace:
        
        /*
        De modo que oResult es un array con un solo personaje (o vacío si no se encuentra). Luego el resto del código genera los elementos HTML para ese personaje — imagen, nombre, año, etc — y los añade al contenedor.
        Por eso en Articulo.html, aunque usas el mismo div id="contenido", se mostrará solo ese personaje seleccionado.
        */
        
        oResult = data.filter(x => x.id ==id);
    } else {
        if (casa == "SinCasa") {
            oResult = data.filter(x => (x.house != "Gryffindor" && x.house != "Hufflepuff" && x.house != "Ravenclaw" && x.house != "Slytherin"));
        } else {
            oResult = data.filter(x => x.house == casa);
        }
    }

    // --------------------------------------------------

    /*
    Se asegura de que todos tengan año numérico.
    Si no hay año, se pone 99999 (se usará para mostrar "Mas viejo que Jorge").
    Luego ordena los personajes por año.
    */

    oResult=oResult.map(x=> {
        let iAnio=0;
        if(x.yearOfBirth && x.yearOfBirth!= null && x.yearOfBirth!= ""){
            iAnio=parseInt(x.yearOfBirth);
        }else{
            iAnio=99999;
        }
        x.yearOfBirth=iAnio;
        return x;
    }).sort((a,b)=>a.yearOfBirth -b.yearOfBirth);

    // ------------------------------------------------------------

    /*
    Se limpia el contenedor antes de mostrar resultados nuevos.
    */

    //console.log("oResult", oResult);
    //PASO 2 RECORREMOS EL ARRAY DE RESULTADOS CON UN FOR OF
    //Y ME CREO EL DIV PRINCIPAL DONDE METER LAS IMAGENES
    let divContenido = document.getElementById('contenido');
    divContenido.innerHTML = "";
    
    /*
    Usa reduce para agrupar personajes por casa.
    Ejemplo: todos los de Gryffindor en un array.
    */
    
    //Funcion flecha q agrupa con reduce
    const groupBy = (arr, key) => {
        return arr.reduce((acc, item) => {
            //Saco la casa
            const k = item[key];

            //Compruebo si es array vacio o no y si es asi inicializo el acumulador con vacio
            acc[k] = acc[k] || [];

            //Añado el item a cada casa
            acc[k].push(item);
            return acc;
        }, {});
    };

    /*
    Se recorre cada grupo y se genera un bloque visual para esa casa.
    */

    let group = groupBy(oResult, "house");
    //console.log("group", group);

    //Recorro cada una de las keys del arr group agrupado
    for (let casa in group) {
        //Extraigo el array de la casa
        let arr = group[casa];

        //Creo el div de la casa
        let divCasa = document.createElement('div');
        divCasa.id = casa;
        divCasa.className = "casa";
        let h1Casa = document.createElement('h1');
        h1Casa.innerText = casa ? casa : "No Afiliation";
        divCasa.appendChild(h1Casa);
        //Uso map para acceder a cada elemento del array
        arr.map(x => {
            
            // -------------------------------------------------------

            /*
            Por cada personaje:
            Si no hay imagen, se usa una de reemplazo (Default.png).
            Se muestran el nombre y el año de nacimiento (si falta, muestra texto divertido).
            */
            
            //Creo las etiquetas en memoria
            let divPersonaje = document.createElement('div');
            divPersonaje.className = "personaje";
            let h3Personaje = document.createElement('h3');
            let h4Anio = document.createElement('h4');
            let imgPersonaje = document.createElement('img');
            let pPersonaje = document.createElement('p');

            //Doy contenido a las etiquetas
            h3Personaje.innerHTML = `<b>${x.name}</b>`;
            h4Anio.innerHTML = `<i>${x.yearOfBirth==99999?'Mas viejo que Jorge':String(x.yearOfBirth)}</i>`;
            imgPersonaje.src = x.image ? x.image : "./imagenes/Deafault.png";
            
            /*
            Guarda el id del personaje en localStorage.
            Redirecciona a la página Artículo, donde se mostrará solo ese personaje.
            */
            
            // Guarda el ID del personaje y redirige al artículo.
            //Añado la funcion onclick a la imagen
            
            /*
            1. Selección + almacenamiento del personaje
            Cuando el usuario está en la página principal (o de listado) —no en Articulo.html—, tu código muestra personajes por “casa” y crea una tarjeta por cada personaje con una imagen.
            En esa tarjeta, le asignas un onclick a la imagen:
            */
            
            imgPersonaje.onclick = function () {
                localStorage.clear();
                localStorage.setItem('id', x.id);
                document.location = 'http://localhost:3000/sesion3/ejercicioHarryPotter/Articulo'
            };
            pPersonaje.innerText = x.alternate_names.length > 0 ? x.alternate_names.join(",") : "";

            /*
            Cada personaje se añade al contenedor de su casa
            Todo va al divContenido.
            */

            //Las añado al divPersonaje
            divPersonaje.appendChild(h3Personaje);
            divPersonaje.appendChild(h4Anio);
            divPersonaje.appendChild(imgPersonaje);
            divPersonaje.appendChild(pPersonaje);

            divCasa.appendChild(divPersonaje);

        });

        //Añado la casa al contenido
        divContenido.appendChild(divCasa);
    }
}

// -----------------------------------------------------

/*
Si estás en la página Artículo, carga solo un personaje desde localStorage.
Si no, muestra por defecto la casa Gryffindor.
*/

/*
Detectar en scripts.js qué página estamos cargando
Se obtiene la URL actual con window.location.href
Si la URL contiene la palabra "Artículo", el código infiere que estás en la página de detalle (Artículo.html).
En ese caso, recupera del localStorage el id que guardamos antes, y llama a datosHarryPotter("", id) para filtrar solo este personaje.
Si no estás en Articulo.html, por defecto muestra la casa "Gryffindor".

La misma función sirve para listado completo y para un solo personaje, dependiendo del parámetro id.

*/


const url = window.location.href;
// console.log("url",url);
// console.log("url aa",url.indexOf("Articulo"));
if(url.indexOf("Articulo")>-1){
    //Saco los datos del localstorage
    let id =localStorage.getItem('id');
    datosHarryPotter("",id);
}else{
    datosHarryPotter("Gryffindor");
}
