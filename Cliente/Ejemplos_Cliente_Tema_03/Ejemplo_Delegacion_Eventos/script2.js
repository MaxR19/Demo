const lista = document.getElementById("lista");
const agregar = document.getElementById("agregar");
const input = document.getElementById("nuevaTarea");
const selectEstado = document.getElementById("estadoTarea");

// 🔄 Mapea estado a clase CSS
const estadoClase = {
    
    "pendiente": "pendiente",
    "en proceso": "en-proceso",
    "completado": "completado"
};

agregar.addEventListener("click", () => {
    const nombre = input.value.trim();
    const estado = selectEstado.value;

    if (nombre === "") return;

    const li = document.createElement("li");

    li.className = estadoClase[estado]; // Aplica color según estado

    li.innerHTML = `
    <span class="nombre">${nombre}</span>
    <select class="estado">
      <option value="pendiente" ${estado === "pendiente" ? "selected" : ""}>Pendiente</option>
      <option value="en proceso" ${estado === "en proceso" ? "selected" : ""}>En proceso</option>
      <option value="completado" ${estado === "completado" ? "selected" : ""}>Completado</option>
    </select>
    <button class="modificar">Modificar</button>
    <button class="eliminar">Eliminar</button>
  `;

    lista.appendChild(li);
    input.value = "";
    selectEstado.value = "pendiente";
});

lista.addEventListener("click", (event) => {
    const li = event.target.closest("li");

    if (event.target.classList.contains("eliminar")) {
        li.remove();
    }

    if (event.target.classList.contains("modificar")) {
        const estado = li.querySelector(".estado").value;

        // 🔄 Elimina clases anteriores de color
        li.classList.remove("pendiente", "en-proceso", "completado");

        // ✅ Aplica clase nueva según estado
        li.classList.add(estadoClase[estado]);
    }
});