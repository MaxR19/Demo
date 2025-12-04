// Mostrar qué objeto global se está utilizando con globalThis
console.log("🚀 globalThis apunta a:", globalThis);

// Verificar compatibilidad del objeto global
if (typeof window !== "undefined") {
  console.log("🌐 Estamos en un navegador");
  console.log("globalThis === window:", globalThis === window); // true
} else if (typeof global !== "undefined") {
  console.log("🟢 Estamos en Node.js");
  console.log("globalThis === global:", globalThis === global); // true
} else {
  console.log("⚠️ Entorno no identificado");
}

// Puedes definir variables globales usando globalThis
globalThis.miVariableGlobal = "Hola desde globalThis 👋";

console.log("Valor de miVariableGlobal:", globalThis.miVariableGlobal);
