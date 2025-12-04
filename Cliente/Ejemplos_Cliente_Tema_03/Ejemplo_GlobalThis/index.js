// inicializamos el contador global solo si no existe aún
if (!globalThis.contadorGlobal) {
  globalThis.contadorGlobal = 0;
}

// Función para aumentar el contador
function incrementarContador() {
  globalThis.contadorGlobal++;
  console.log("🔼 Contador incrementado:", globalThis.contadorGlobal);
}

// Función para resetear el contador
function resetearContador() {
  globalThis.contadorGlobal = 0;
  console.log("🔁 Contador reiniciado");
}

// Función para mostrar el valor actual
function mostrarContador() {
  console.log("🔢 Valor actual:", globalThis.contadorGlobal);
}

// Simulación de uso
incrementarContador(); // 🔼 1
incrementarContador(); // 🔼 2
mostrarContador();     // 🔢 2
resetearContador();    // 🔁
mostrarContador();     // 🔢 0
