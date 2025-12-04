import express from 'express';
import path from 'path';
import { fileURLToPath } from 'url'; 

const app = express();
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
//Necesario para poder hacer get de ficheros estáticos
app.use(express.static(path.join(__dirname, '')));

//Necesario para poder recibir post de forms html
app.use(express.urlencoded({ extended: true }));

//++ TEMA 03

app.get('/Ejemplos_Cliente_Tema_03/Ejemplo_GlobalThis', (req, res) => {
  res.sendFile(path.join(__dirname, 'Ejemplos_Cliente_Tema_03', 'Ejemplo_GlobalThis', 'index.html'));
});

app.get('/Ejemplos_Cliente_Tema_03/Ejemplo_DOM', (req, res) => {
  res.sendFile(path.join(__dirname, 'Ejemplos_Cliente_Tema_03', 'Ejemplo_DOM', 'index.html'));
});

app.get('/Ejercicios_Cliente_Tema_03/Ejercicio_DragonBall', (req, res) => {
  res.sendFile(path.join(__dirname, 'Ejercicios_Cliente_Tema_03', 'Ejercicio_DragonBall', 'index.html'));
});

app.get('/Ejercicios_Cliente_Tema_03/Ejercicio_DragonBall/Listado', (req, res) => {
  res.sendFile(path.join(__dirname, 'Ejercicios_Cliente_Tema_03', 'Ejercicio_DragonBall', 'Listado', 'listado.html'));
});

app.get('/Ejercicios_Cliente_Tema_03/Ejercicio_DragonBall/Articulo', (req, res) => {
  res.sendFile(path.join(__dirname, 'Ejercicios_Cliente_Tema_03', 'Ejercicio_DragonBall', 'Articulo', 'articulo.html'));
});

//-- TEMA 03

// Arrancamos el servidor
app.listen(3000, () => {
  console.log('Servidor corriendo en http://localhost:3000');
});