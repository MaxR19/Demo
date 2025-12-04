// Magia interactiva para la página de Harry Potter

// Efecto de chispas mágicas al mover el ratón
document.addEventListener('mousemove', function (e) {
    const spark = document.createElement('div');
    spark.className = 'spark';
    document.body.appendChild(spark);

    spark.style.left = e.pageX + 'px';
    spark.style.top = e.pageY + 'px';

    setTimeout(() => {
        spark.remove();
    }, 500);
});

// Mensaje mágico en el contenido principal
window.addEventListener('DOMContentLoaded', () => {
    const cont = document.getElementById('contenido');
    if (cont) {
        cont.innerHTML = `
            <h1 style="text-shadow: 0 0 15px gold;">Bienvenido al Mundo Mágico</h1>
            <p>Explora Hogwarts, aprende hechizos y sumérgete en la aventura.</p>
        `;
    }
});

// Sonido suave al pasar por los enlaces del menú
const enlaces = document.querySelectorAll('nav a');
const sonido = new Audio('../sonidos/spell.wav');

enlaces.forEach(enlace => {
    enlace.addEventListener('mouseenter', () => {
        sonido.currentTime = 0;
        sonido.play();
    });
});

// Crear chispas mágicas con CSS dinámico
const style = document.createElement('style');
style.textContent = `
    .spark {
        position: absolute;
        width: 10px;
        height: 10px;
        background: radial-gradient(circle, gold, transparent);
        pointer-events: none;
        border-radius: 50%;
        animation: fade 0.5s linear;
    }

    @keyframes fade {
        from { opacity: 1; transform: scale(1); }
        to { opacity: 0; transform: scale(2); }
    }
`;
document.head.appendChild(style);
