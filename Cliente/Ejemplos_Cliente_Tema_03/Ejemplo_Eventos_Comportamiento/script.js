const formulario = document.getElementById("formulario");
const nombreInput = document.getElementById("nombre");
const mensaje = document.getElementById("mensaje");

formulario.addEventListener("submit", function (event) {
  event.preventDefault(); // 🚫 Evita que el formulario se envíe y recargue la página

  const nombre = nombreInput.value.trim();

  if (nombre === "") {
    mensaje.textContent = "⚠️ El nombre es obligatorio.";
    mensaje.className = "error";
  } else {
    mensaje.textContent = `✅ ¡Formulario enviado correctamente, hola ${nombre}!`;
    mensaje.className = "success";

    // Aquí podrías enviar los datos por fetch/ajax si quisieras
    formulario.reset(); // Limpia el formulario
  }
});
