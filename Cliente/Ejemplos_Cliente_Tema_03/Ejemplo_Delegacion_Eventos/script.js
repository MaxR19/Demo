const lista = document.getElementById("lista");
const agregar = document.getElementById("agregar");
const input = document.getElementById("nuevaTarea");

// Agregar nueva tarea
agregar.addEventListener("click", () => {
  const texto = input.value.trim();
  if (texto === "") return;

  const li = document.createElement("li");
  li.innerHTML = `${texto} <button class="eliminar">🗑️</button>`;
  lista.appendChild(li);
  input.value = "";
});

// Delegación de eventos en el contenedor UL
lista.addEventListener("click", (event) => {
  if (event.target.classList.contains("eliminar")) {
    const li = event.target.closest("li");
    li.remove();
  }
});
