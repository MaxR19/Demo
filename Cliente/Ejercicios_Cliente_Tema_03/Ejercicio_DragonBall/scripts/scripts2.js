/*
Este archivo se encarga de:
- Obtener personajes de Dragon Ball desde una API
- Mostrar los datos en una tabla HTML
- Guardar el personaje seleccionado en localStorage y redirigir al artículo

*/

// ----------------------------------------------------------------

/*
Esta función hace una petición HTTP GET a la url que se le pase como parámetro usando fetch().
Espera la respuesta (await) y la convierte en JSON (.json()).
Retorna ese JSON como un objeto JS. 
*/

async function llamadaAPI(url) {
    
    let cuerpo_respuesta = await fetch(url);
    
    let datos = await cuerpo_respuesta.json();
    return datos;
}

// ---------------------------------------------------------------------

/*
Define la URL de la API que devuelve personajes de Dragon Ball.
Llama a la función anterior para obtener los datos
Aquí, data.items es un array de personajes.
*/

async function datosDragonBall() {
    const url = "https://dragonball-api.com/api/characters";

    
    let data = await llamadaAPI(url);
    console.log("data", data);
    let oResult = data.items;
    
    // --------------------------------------------------------------

    /*
    Obtiene el div para insertar la tabla
    Crea dinámicamente una etiqueta <table> y le aplica la clase tabla.
    */

    let divContenido = document.getElementById('contenido')
    let table = document.createElement('table');
    table.classList.add('tabla');

    // ------------------------------------------------------------

    /*
    Recorre las propiedades del primer personaje para generar las columnas de la tabla.
    Excluye la propiedad description
    Crea una fila con cabeceras (<th>) con los nombres de las propiedades.
    */
    
    let tr_th = document.createElement('tr');
    for (let prop in oResult[0]) {
        if(prop!='description'){
            let th = document.createElement('th');
            th.innerText = prop;
            tr_th.appendChild(th);
        }
        
    }
    table.appendChild(tr_th);

    // -----------------------------------------------------------------

    /*
    Itera sobre cada personaje.
    Crea una fila <tr> para cada uno.
    Dentro de cada personaje, itera sobre sus propiedades (excepto description)
    */

    for (let res of oResult) {
        let tr_td = document.createElement('tr');

        for (let dat in res) {
            let td = document.createElement('td');
            if(dat!='description'){

                // ---------------------------------------------------

                /*
                Si la propiedad es name, al hacer clic:
                - Se borra localStorage
                - Se guarda el personaje actual como string JSON bajo la clave 'personaje'.
                - Se redirige a la página de artículo, donde se usará esta información.
                */

                if(dat=='name'){
                    
                    td.innerText = res[dat];
                    td.style.cursor='pointer';
                    td.style.color='#0000FF';
                    td.onclick= function () {
                        localStorage.clear();
                        localStorage.setItem('personaje',JSON.stringify(res));
                        document.location='http://localhost:3000/Ejercicios_Cliente_Tema_03/Ejercicio_DragonBall/Articulo';
                    };
                }else{
                    td.innerText = res[dat];
                }

                // --------------------------------------------------------------

                /*
                Se añade cada fila a la tabla
                Finalmente, se inserta la tabla completa dentro del div #contenido.
                */
                
                tr_td.appendChild(td);
            }
            
        }
        table.appendChild(tr_td);
    }
    divContenido.appendChild(table);
}

// ------------------------------------------------------------------

/*
Llama a la función principal para que se ejecute automáticamente al cargar la página.
*/

datosDragonBall();