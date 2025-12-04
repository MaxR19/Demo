/*
Este archivo está diseñado para mostrar en articulo.html los datos del personaje que se 
guardaron en el localStorage desde las otras páginas 
Este script recupera los datos guardados de un personaje de Dragon Ball 
y los muestra en pantalla con su imagen, nombre y descripcion
*/

/* 
Esta función busca en el localStorage la clave 'personaje' que se guardó al hacer clic en un personaje.
El valor es un string JSON
Convierte ese string JSON en un objeto JavaScript para poder acceder a sus propiedades. 
Se extraen tres propiedades clave del personaje.
*/

function datosNoticia() {
    let sres = localStorage.getItem('personaje');
    let divContenido = document.getElementById('contenido')
    let res = JSON.parse(sres);
    let nomPersonaje = res.name;
    let desPersonaje = res.description;
    let imgPersonaje = res.image;

    // ----------------------------------------------------------------

    /*
    Se asegura que exista una imagen válida antes de continuar.
    Se crea un div contenedor
    Se le asigna una clase CSS (ancho180p)
    Se crea la etiqueta <img> con la URL, texto alternativo y título del personaje.
    */

    if (imgPersonaje != null && imgPersonaje != undefined) {
        
        let divImg = document.createElement('div');
        divImg.classList.add('ancho100p');
        let img = document.createElement('img');
        img.src = imgPersonaje;
        img.alt = nomPersonaje;
        img.title = nomPersonaje;

        // ----------------------------------------------------------

        /*
        Cuando se hace clic en la imagen:
        Se limpia el localStorage.
        Se vuelve a guardar el personaje
        Se recarga la misma página.
        */

        img.onclick = function (res) {
            localStorage.clear();
            localStorage.setItem('personaje', JSON.stringify(res));
            document.location = 'http://localhost:3000/Ejercicios_Cliente_Tema_03/Ejercicio_DragonBall/Articulo'
        };

        // -----------------------------------------------------------

        /*
        Se crean los elementos <h1> y <p> con el nombre y la descripción del personaje.
        */

        //Inserto el titulo
        let h1 = document.createElement('h1');
        h1.innerText = nomPersonaje;
        
        //Inserto el texto breve
        let p = document.createElement('p');
        p.innerText = desPersonaje;
        
        /*
        Se agregan todos los elementos al divImg y finalmente
        ese divImg se añade al div con id="contenido" en la página
        */

        //Inserto como hijo la imagen al div
        divImg.appendChild(img);

        //Inserto como hijo el titulo al div
        divImg.appendChild(h1);

        //Inserto como hijo el parrafo al div
        divImg.appendChild(p);

        //Inserto como hijo al div principal
        divContenido.appendChild(divImg);
    }
}

// -------------------------------------------------------------

/*
Se ejecuta la función inmediatamente al cargar la página, mostrando la info del personaje.
*/

datosNoticia();