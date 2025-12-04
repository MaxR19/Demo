// Objeto manejador de eventos
const manejadorCaja = {
  contador: 0,

  handleEvent(event) {
    if (event.type === "click") {
      this.contador++;
      this.cambiarColor(event.target);
      this.mostrarMensaje(event.target);
      console.log(event.target);
    }
  },

  cambiarColor(elemento) {
    const colores = ["#ffadad", "#ffd6a5", "#caffbf", "#9bf6ff", "#bdb2ff"];
    elemento.style.backgroundColor = colores[this.contador % colores.length];
  },

  mostrarMensaje(elemento) {
    elemento.textContent = `Clics: ${this.contador}`;
  }
};

const caja = document.getElementById("caja");

// ✅ Aquí usamos un OBJETO como manejador del evento
caja.addEventListener("click", manejadorCaja);
