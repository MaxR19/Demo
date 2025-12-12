/*
Este archivo es responsable de: 
- cargar datos desde una API externa de Dragon Ball, 
- mostrarlos en pantalla y 
- guardar un personaje en el localStorage cuando se hace clic sobre su imagen.
*/

// -------------------------------------------------------------------

/*
Esta función es una utilidad genérica para consumir APIs:
Recibiendo una URL como parámetro, usa fetch para hacer una petición HTTP a esa URL, 
con await esperando a que llegue la respuesta. 
Esta respuesta la convierte a JSON y lo devuelve como un objeto.   
*/

async function llamadaAPI(url) {
    
    let cuerpo_respuesta = await fetch(url);
    
    let datos = await cuerpo_respuesta.json();
    return datos;
}

// -------------------------------------------------------------------

/* 
Esta función define la URL de la API de Dragon Ball,
llama a la función llamadaAPI para obtener los datos y accede al array items, 
que contiene a los personajes.  
*/

async function datosDragonBall() {
    const url = "https://dragonball-api.com/api/characters";

    
    let data = await llamadaAPI(url);
    console.log("data", data);
    // let oResult = data.items;

    // -------------------------------------------------------

    /*
    Obtiene el div donde se van a mostrar los personajes, recorre cada personaje dentro
    de la variable oResult y extrae su nombre, descripción e imagen. 
    */

    let divContenido = document.getElementById('contenido')
    for (let res of oResult) {
        let nomPersonaje=res.name;
        let desPersonaje=res.description;
        let imgPersonaje=res.image;

        // ---------------------------------------------------
        
        /*
        Crea un div para cada personaje con la clase ancho200 y crea una etiqueta
        img con su src, alt y title.
        */

        if (imgPersonaje != null && imgPersonaje != undefined) {
            
            let divImg = document.createElement('div');
            divImg.classList.add('ancho200');
            let img = document.createElement('img');
            img.src = imgPersonaje;
            img.alt = nomPersonaje;
            img.title = nomPersonaje;

            // -------------------------------------------------------

            /*
            Cuando se hace clic en la imagen de un personaje:
            - Limpia el localStorage
            - Guarda el personaje actual como string JSON bajo la clave 'personaje'.
            - Redirige al archivo Articulo, que se espera que lea este dato y lo muestre.
            */
            
            img.onclick = function () {
                localStorage.clear();
                localStorage.setItem('personaje',JSON.stringify(res));
                document.location='http://localhost:3000/Ejercicios_Cliente_Tema_03/Ejercicio_DragonBall/Articulo'
            };
            
            // -----------------------------------------------------

            /*
            Añade la imagen, el nombre y la descripción al div del personaje y añade ese div 
            a la página dentro de #contenido.
            */

            divImg.appendChild(img);

            
            let h1 = document.createElement('h1');
            h1.innerText=nomPersonaje;
            
            divImg.appendChild(h1);

            
            let p = document.createElement('p');
            p.innerText=desPersonaje;

            
            divImg.appendChild(p);

            
            divContenido.appendChild(divImg);
        }
    }

}

// ----------------------------------------------------------------

/*
Se llama directamente a la función datosDragonBall() para que el contenido se
cargue automáticamente al cargar la página.
*/

datosDragonBall();