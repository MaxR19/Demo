const contenedor = document.getElementById('contenedor');

// Modifica el texto del primer párrafo
function modificarTexto() {
  const parrafo = document.getElementById('parrafo1');
  parrafo.textContent = "✅ ¡Texto modificado exitosamente!";
}

// Crea e inserta un nuevo párrafo
function insertarNuevo() {
  const nuevo = document.createElement('p');
  nuevo.textContent = "🆕 Este es un nuevo párrafo insertado.";
  contenedor.append(nuevo);
}

// Clona el último párrafo y lo agrega al final
function clonarUltimo() {
  const ultimo = contenedor.lastElementChild;
  const clon = ultimo.cloneNode(true);
  contenedor.append(clon);
}

// Elimina el último párrafo
function eliminarUltimo() {
  const ultimo = contenedor.lastElementChild;
  if (ultimo && contenedor.children.length > 1) {
    contenedor.removeChild(ultimo);
  }
}

// Resalta el primer párrafo con una clase
function resaltarPrimero() {
  const primero = contenedor.firstElementChild;
  primero.classList.toggle('resaltado');
}
