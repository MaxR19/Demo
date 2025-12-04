const contenedor = document.getElementById("contenedor");
const infoBox = document.getElementById("infoBox");

// ✅ Captura evento desde HTML inline
function mostrarEvento(event) {
  alert(`Evento recibido desde HTML.
Target: ${event.target.tagName}`);
}

// ✅ Escucha clicks en todo el contenedor
contenedor.addEventListener("click", function(event) {
  const target = event.target;
  console.log(target);
  const currentTarget = event.currentTarget;
  console.log(currentTarget);

  // Mostrar información del evento
  infoBox.textContent = `📌 target: ${target.className} | currentTarget: ${currentTarget.id}`;
  console.log(this.infoBox);

  // Estilo visual para el que fue clickeado
  if (target.classList.contains("elemento")) {
    target.style.backgroundColor = "#d1ffd1";
    setTimeout(() => {
      target.style.backgroundColor = "white";
    }, 500);
  }
});
