const boton = document.getElementById("botonContador");
const boton2 = document.getElementById("botonContador2");
const contadorDisplay = document.getElementById("contador");

let clics = 0;

function manejarClic() {
  clics++;
  console.log("Número de clics: ", clics);
  contadorDisplay.textContent = `Clics: ${clics}`;

  if (clics >= 3) {
    boton.removeEventListener("click", manejarClic);
    boton.disabled = true;
    boton.textContent = "⛔ Límite alcanzado";
    boton2.style.display = "inline-block";
  }
}

function activarBoton() {
    clics = 0;
    contadorDisplay.textContent = "Clics: 0";
    boton.disabled = false;
    boton.textContent = "Haz clic (3 veces máximo)";
    boton2.style.display = "none";
    boton.addEventListener("click", manejarClic); // volver a conectar
}

boton.addEventListener("click", manejarClic);
boton2.addEventListener("click", activarBoton);