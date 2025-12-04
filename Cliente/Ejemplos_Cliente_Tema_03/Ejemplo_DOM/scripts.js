const contenedor = document.getElementById('contenedor');
let actual = contenedor.firstElementChild;

function resaltar(elemento) {
  resetear();
  if (elemento) {
    elemento.classList.add('seleccionado');
  }
}

function resaltarPrimerHijo() {
  actual = contenedor.firstElementChild;
  resaltar(actual);
}

function resaltarUltimoHijo() {
  actual = contenedor.lastElementChild;
  resaltar(actual);
}

function resaltarSiguiente() {
  if (actual && actual.nextElementSibling) {
    actual = actual.nextElementSibling;
    resaltar(actual);
  }
}

function resaltarAnterior() {
  if (actual && actual.previousElementSibling) {
    actual = actual.previousElementSibling;
    resaltar(actual);
  }
}

function resetear() {
  const hijos = contenedor.children;
  for (let hijo of hijos) {
    hijo.classList.remove('seleccionado');
  }
}
