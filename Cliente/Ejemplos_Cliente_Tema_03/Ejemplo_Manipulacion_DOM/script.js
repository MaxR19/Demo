function obtenerUbicacion() {
    const resultado = document.getElementById("resultado");

    if (!navigator.geolocation) {
        resultado.textContent = "🚫 Geolocalización no soportada por este navegador.";
        resultado.classList.add("error");
        return;
    }

    resultado.textContent = "⌛ Obteniendo ubicación...";

    navigator.geolocation.getCurrentPosition(
        (position) => {
            const { latitude, longitude } = position.coords;

            resultado.textContent = `✅ Tu ubicación actual es:
      Latitud: ${latitude.toFixed(5)}, 
      Longitud: ${longitude.toFixed(5)}`;
            resultado.classList.remove("error");
        },
        (error) => {
            console.error("Código de error:", error.code);
            console.error("Mensaje:", error.message);
            resultado.textContent = `❌ Error al obtener la ubicación: ${error.message}`;
            resultado.classList.add("error");
        }

    );
}
