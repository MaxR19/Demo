// Definición de la clase del Custom Element
class MiContador extends HTMLElement {
  // Atributos que se observarán para detectar cambios
  static get observedAttributes() {
    return ['valor', 'pepino'];
  }

  constructor() {
    super(); // Siempre llamar a super() en el constructor
    this.valor = parseInt(this.getAttribute('valor')) || 0;
  }

  // Se ejecuta cuando el elemento se añade al DOM
  connectedCallback() {
    this.render();
    this.addEventListener('click', this.incrementar);
    this.addEventListener('click', this.cambiarValorPepino);
  }

  // Se ejecuta cuando se quita del DOM
  disconnectedCallback() {
    this.removeEventListener('click', this.incrementar);
  }

  // Se ejecuta cuando se cambia un atributo observado
  attributeChangedCallback(nombre, valorAntiguo, valorNuevo) {
    if (nombre === 'valor') {
      this.valor = parseInt(valorNuevo);
      this.render();
    }

    if (nombre === 'pepino') {
      //alert(this.getAttribute('pepino'));
    }
  }

  // Método para incrementar el contador
  incrementar = () => {
    this.valor++;
    this.setAttribute('valor', this.valor);
  }
  cambiarValorPepino = () => {
    this.setAttribute('pepino', 'Pepino Marino' + String(this.valor));
  }

  // Método para actualizar el contenido del elemento
  render() {
    this.textContent = `Contador: ${this.valor}`;
  }
}

class MiRestador extends HTMLElement {
  // Atributos que se observarán para detectar cambios
  static get observedAttributes() {
    return ['valorrestado'];
  }

  constructor() {
    super(); // Siempre llamar a super() en el constructor
    this.valorrestado = parseInt(this.getAttribute('valorrestado')) || 0;
  }

  // Se ejecuta cuando el elemento se añade al DOM
  connectedCallback() {
    this.render();
    this.addEventListener('click', this.restar);
  }

  // Se ejecuta cuando se quita del DOM
  disconnectedCallback() {
    this.removeEventListener('click', this.restar);
  }

  // Se ejecuta cuando se cambia un atributo observado
  attributeChangedCallback(nombre, valorAntiguo, valorNuevo) {
    if (nombre === 'valorrestado') {
      this.valorrestado = parseInt(valorNuevo);
      this.render();
    }
  }

  // Método para incrementar el contador
  restar = () => {
    this.valorrestado--;
    this.setAttribute('valorrestado', this.valorrestado);
  }

  // Método para actualizar el contenido del elemento
  render() {
    this.textContent = `Contador Restado: ${this.valorrestado}`;
  }
}

class MiMultiplicador extends HTMLElement {
  // Atributos que se observarán para detectar cambios
  static get observedAttributes() {
    return ['valor'];
  }

  constructor() {
    super(); // Siempre llamar a super() en el constructor
    this.valor = parseInt(this.getAttribute('valor')) || 1;
  }

  // Se ejecuta cuando el elemento se añade al DOM
  connectedCallback() {
    this.render();
    this.addEventListener('click', this.multiplicar);
  }

  // Se ejecuta cuando se quita del DOM
  disconnectedCallback() {
    this.removeEventListener('click', this.multiplicar);
  }

  // Se ejecuta cuando se cambia un atributo observado
  attributeChangedCallback(nombre, valorAntiguo, valorNuevo) {
    if (nombre === 'valor') {
      this.valor = parseInt(valorNuevo);
      this.render();
    }

  }

  // Método para incrementar el contador
  multiplicar = () => {
    this.valor = this.valor * 2;
    this.setAttribute('valor', this.valor);
  }

  // Método para actualizar el contenido del elemento
  render() {
    this.textContent = `Contador: ${this.valor}`;
  }
}

class MiTabla extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.data = [];
  }

  set data(value) {
    this._data = value;
    this.render();
  }

  get data() {
    return this._data;
  }

  connectedCallback() {
    // Datos iniciales
    this.data = [
      { nombre: 'Ana', edad: 28, ciudad: 'Madrid' },
      { nombre: 'Luis', edad: 35, ciudad: 'Valencia' },
    ];
  }

  render() {
    if (!this.shadowRoot) return;
    const data = this._data || [];
    this.shadowRoot.innerHTML = `
      <style>
        table { border-collapse: collapse; width: 100%; font-family: sans-serif; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        th { background: #f4f4f4; }
      </style>
      <table>
        <thead>
          <tr>${data.length ? Object.keys(data[0]).map(k => `<th>${k}</th>`).join('') : ''}</tr>
        </thead>
        <tbody>
          ${data.map(row => `<tr>${Object.values(row).map(v => `<td>${v}</td>`).join('')}</tr>`).join('')}
        </tbody>
      </table>
    `;
  }
}


class MiDivTabluno extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.dataDiv = [];
  }

  set dataDiv(value) {
    this._dataDiv = value;
    this.render();
  }

  get dataDiv() {
    return this._dataDiv;
  }

  connectedCallback() {
    // Datos iniciales
    this.dataDiv = [
      { nombre: 'Ana', edad: 28, ciudad: 'Madrid' },
      { nombre: 'Luis', edad: 35, ciudad: 'Valencia' },
    ];
  }

  render() {
    if (!this.shadowRoot) return;
    const data = this._dataDiv || [];

    //Añado al principio la referencia de estilo
    let sHTML = `<link rel="stylesheet" href="estilos.css">`;
    // let sHTML = "";
    sHTML += '<div>';
    if (data.length) {
      //Añado la primera fila
      sHTML += '<div id="Cabecera">';
      let oCabecera = Object.keys(data[0]);
      for (let cab of oCabecera) {
        sHTML += '<div>' + cab + "</div>";
      }
      sHTML += '</div>';
      for (let row of data) {
        //Añado el resto de las filas
        sHTML += '<div class="fila">';
        let oFila = Object.values(row);
        for (let fil of oFila) {
          sHTML += '<div>' + fil + "</div>";
        }
        sHTML += "</div>";
      }
    }
    sHTML += '</div>';
    this.shadowRoot.innerHTML = sHTML;
  }

}

class MiDivTablunoAchild extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.dataDiv = [];
  }

  set dataDiv(value) {
    this._dataDiv = value;
    this.render();
  }

  get dataDiv() {
    return this._dataDiv;
  }

  connectedCallback() {
    // Datos iniciales
    this.dataDiv = [
      { nombre: 'Ana', edad: 28, ciudad: 'Madrid' },
      { nombre: 'Luis', edad: 35, ciudad: 'Valencia' },
    ];
  }

  render() {
    if (!this.shadowRoot) return;
    const data = this._dataDiv || [];

    //Creamos el div principal
    let div = document.createElement("div");

    if (data.length) {
      //Creamos el div de cabecera
      let divCabecera = document.createElement("div");
      divCabecera.id = "Cabecera";

      //Extraemos los datos de los nombres de los campos de nuestro JSON
      let oCabecera = Object.keys(data[0]);
      for (let cab of oCabecera) {

        //Creamos un div hijo por cada valor de la cabecera
        let divHijo = document.createElement("div");
        divHijo.innerText = cab;

        //Se lo añadimos como hijo a la cabecera
        divCabecera.appendChild(divHijo);
      }
      //Añadimos la cabecera al principal
      div.appendChild(divCabecera);

      for (let row of data) {
        //Añado el resto de las filas
        let divFila = document.createElement("div");
        divFila.className = "fila";
        let oFila = Object.values(row);
        for (let fil of oFila) {
          let divHijoFila = document.createElement("div");
          divHijoFila.innerText = fil;

          //Se lo añadimos como hijo a la cabecera
          divFila.appendChild(divHijoFila);
        }

        //Añadimos cada una de las filas al principal
        div.appendChild(divFila);
      }
    }

    //Añado la hoja de estilos
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = 'estilos.css';
    this.shadowRoot.appendChild(link);
    this.shadowRoot.appendChild(div);

  }
}

customElements.define('mi-tabla', MiTabla);
customElements.define('mi-div-tabluno', MiDivTabluno);
customElements.define('mi-div-tabluno-a-child', MiDivTablunoAchild);


// Registrar el elemento personalizado
customElements.define('mi-contador', MiContador);
customElements.define('mi-restador', MiRestador);
customElements.define('mi-multiplicador', MiMultiplicador);

const tabla = document.querySelector('mi-tabla');
tabla.data = [
  { nombre: 'Mario', edad: 30, ciudad: 'Bilbao', pepino: 'Bilbao' },
  { nombre: 'Lucía', edad: 25, ciudad: 'Granada', pepino: 'Madrid' },
];

const div = document.querySelector('mi-div-tabluno');
div.dataDiv = [
  { nombre: 'Mario', edad: 30, ciudad: 'Bilbao', pepino: 'Bilbao' },
  { nombre: 'Lucía', edad: 25, ciudad: 'Granada', pepino: 'Madrid' },
];