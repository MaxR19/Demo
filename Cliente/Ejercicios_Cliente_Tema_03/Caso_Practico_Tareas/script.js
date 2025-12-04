// Variables globales
const taskInput = document.getElementById('taskInput');
const addTaskBtn = document.getElementById('addTaskBtn');
const taskList = document.getElementById('taskList');

// Cargar tareas del localStorage
function loadTasks() {
    const tasks = JSON.parse(localStorage.getItem('tasks')) || [];
    tasks.forEach(task => {
        addTaskToDOM(task);
    });
}

// Agregar tarea al DOM
function addTaskToDOM(task) {
    const li = document.createElement('li');
    li.textContent = task.text;

    if (task.completed) {
        li.classList.add('completed');
    }

    li.addEventListener('click', () => {
        toggleTaskCompletion(task);
    });

    const deleteBtn = document.createElement('button');
    deleteBtn.textContent = 'Eliminar';

    deleteBtn.addEventListener('click', (e) => {
        e.stopPropagation(); // Prevenir que se dispare el evento de clic en el li
        deleteTask(task);
    });

    li.appendChild(deleteBtn);
    taskList.appendChild(li);
}

// Cargar tareas al iniciar
document.addEventListener('DOMContentLoaded', loadTasks);

// Agregar nueva tarea
addTaskBtn.addEventListener('click', () => {
    const taskText = taskInput.value.trim();
    if (taskText === '') return;

    const newTask = { text: taskText, completed: false };
    addTaskToDOM(newTask);
    saveTask(newTask);
    taskInput.value = ''; // Limpiar input
});

// Guardar tarea en el localStorage
function saveTask(task) {
    const tasks = JSON.parse(localStorage.getItem('tasks')) || [];
    tasks.push(task);
    localStorage.setItem('tasks', JSON.stringify(tasks));
}

// Alternar estado del completado
function toggleTaskCompletion(task) {
    const tasks = JSON.parse(localStorage.getItem('tasks'));

    const updatedTasks = tasks.map(t => {
        if (t.text === task.text) {
            t.completed = !t.completed;

            if (t.completed) {
                taskList.querySelectorAll('li').forEach(li => {
                    if (li.textContent.includes(task.text)) {
                        li.classList.add('completed');
                    }
                });
            } else {
                taskList.querySelectorAll('li').forEach(li => {
                    if (li.textContent.includes(task.text)) {
                        li.classList.remove('completed');
                    }
                });
            }
        }
        return t;
    });

    localStorage.setItem('tasks', JSON.stringify(updatedTasks));
}

// Eliminar tarea
function deleteTask(task) {
    const tasks = JSON.parse(localStorage.getItem('tasks'));
    const updatedTasks = tasks.filter(t => t.text !== task.text);
    localStorage.setItem('tasks', JSON.stringify(updatedTasks));
    taskList.innerHTML = ''; // Limpiar la lista
    loadTasks(); // Recargar tareas
}