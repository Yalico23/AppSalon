let paso = 1; //como es un let va a variar

const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
  Id: "",
  Nombre: "",
  Fecha: "",
  Hora: "",
  Servicios: [],
};

document.addEventListener("DOMContentLoaded", function () {
  IniciarApp();
});

function IniciarApp() {
  //Solo se llama una sola vez
  tabs();
  mostrarSeccion(); //para que se muestre automaticamente al cargar la pagina luego sigue los eventos de los click en tabs()
  botonesPaginador(); //Agrega o quita los botones del paginador
  pagSiguiente();
  pagAnterior();
  //api
  ConsumirApi(); //Consulta la API en el backend de PHP
  nombreCliente(); //Agregar el nombre a nuestro objeto cita
  IDCliente();
  seleccionarFecha();
  seleccionarHora();
  //resumen
  mostrarResumen();
}

function tabs() {
  //se llama cada vez que cambia
  const botones = document.querySelectorAll(".tabs button");
  botones.forEach((boton) => {
    boton.addEventListener("click", function (e) {
      //console.log(parseInt(e.target.dataset.paso));
      paso = parseInt(e.target.dataset.paso);
      mostrarSeccion();
      botonesPaginador(); //aqui agrego el metodo mostrarResumen en caso de que use el tab o los botones se aplica el mostrarResumen
    });
  });
}
function mostrarSeccion() {
  //Ocultar la seccion que tenga la clase de mostrar
  const seccionmostrar = document.querySelector(".mostrar");
  if (seccionmostrar) {
    seccionmostrar.classList.remove("mostrar");
  }
  //Seleccionar la sección con el paso
  const seccion = document.querySelector(`#paso-${paso}`);
  seccion.classList.add("mostrar");

  //Ocultar el tab
  const tabAnterior = document.querySelector(".actual");
  if (tabAnterior) {
    tabAnterior.classList.remove("actual");
  }
  //Resalta el tabs actual
  const tab = document.querySelector(`[data-paso="${paso}"]`);
  tab.classList.add("actual");
}

function botonesPaginador() {
  const paginaSiguiente = document.querySelector("#siguiente");
  const paginaAnterior = document.querySelector("#anterior");

  if (paso === 1) {
    paginaAnterior.classList.add("ocultar");
    paginaSiguiente.classList.remove("ocultar");
  } else if (paso === 3) {
    paginaAnterior.classList.remove("ocultar");
    paginaSiguiente.classList.add("ocultar");
    mostrarResumen(); //cuando usen las flechas se muestra
  } else {
    paginaAnterior.classList.remove("ocultar");
    paginaSiguiente.classList.remove("ocultar");
  }
  mostrarSeccion();
}

function pagAnterior() {
  const btnSiguiente = document.querySelector("#anterior");
  btnSiguiente.addEventListener("click", function () {
    // Verifica si el valor de la variable "paso" es menor o igual al valor de "pasoInicial"
    if (paso <= pasoInicial) return;
    // Si la condición anterior no se cumple, disminuye el valor de "paso" en 1
    paso--;
    botonesPaginador();
  });
}
function pagSiguiente() {
  const btnSiguiente = document.querySelector("#siguiente");
  btnSiguiente.addEventListener("click", function () {
    // Verifica si el valor de la variable "paso" es menor o igual al valor de "pasoInicial"
    if (paso >= pasoFinal) return;
    // Si la condición anterior no se cumple, disminuye el valor de "paso" en 1
    paso++;
    botonesPaginador();
  });
}
async function ConsumirApi() {
  try {
    //el try catch evita que por un error dentro de este no perjudique a las demas funciones y muestra un mensaje de error
    const url = `${location.origin}/api/servicios`; //URL del modelo servicios
    const resultado = await fetch(url); //CArga la api y gracias al await no se ejecuta otra funcion hasta que este termine
    //console.log(resultado);
    const servicios = await resultado.json(); //agrego el await porque asi mando un array y no una promesa
    //console.log(servicios);
    mostrarServicios(servicios); //servicios es un arreglo
  } catch (error) {
    console.log(error);
  }
}

function mostrarServicios(servicios) {
  servicios.forEach((servicio) => {
    const { Id, Nombre, Precio } = servicio; //Destructuring para usar variables propiedades del objeto de servicio
    //console.log(Id,Nombre);
    const nombreServicio = document.createElement("P");
    nombreServicio.classList.add("nombre-servicio");
    nombreServicio.textContent = Nombre;
    //console.log(nombreServicio);
    const precioServicio = document.createElement("P");
    precioServicio.classList.add("precio-servicio");
    precioServicio.textContent = `S/.${Precio}`;
    //console.log(precioServicio);
    const servicioDiv = document.createElement("DIV");
    servicioDiv.classList.add("servicio");
    servicioDiv.dataset.idServicio = Id;
    servicioDiv.onclick = function () {
      seleccionarServicio(servicio); //usamos un callback
    }; //agregamos una funcion por cada click que se le da
    //console.log(servicioDiv);
    servicioDiv.appendChild(nombreServicio);
    servicioDiv.appendChild(precioServicio);
    //insertando html al index de cita
    document.querySelector("#servicios").appendChild(servicioDiv);
  });
}

function seleccionarServicio(servicio) {
  //console.log(servicio); servicio: el objeto que dimos click
  const { Servicios } = cita;
  const { Id } = servicio;

  //Comprobar si un servicio ya fue agregado
  if (Servicios.some((agregado) => agregado.Id === Id)) {
    //console.log("Ya esta agregado");
    //Eliminarlo
    cita.Servicios = Servicios.filter((agregado) => agregado.Id !== Id);
  } else {
    //console.log("No esta agregado");
    //Agregarlo (en caso de la funcion)

    //console.log(servicios); servicios = el array del objeto de cita
    cita.Servicios = [...Servicios, servicio]; //(spread operator)  .. cita.servicios (el arreglo de servicios), tendra el formato de servicos pero con los valores de servico; mejor dicho reescribe
  }
  //console.log(cita);
  /**Cambiar la apariencia de un servicio seleccionado */
  const divServicio = document.querySelector(`[data-id-servicio="${Id}"]`);
  divServicio.classList.toggle("seleccionado");
}

function IDCliente() {
  const inputId = document.querySelector("#Id").value;
  cita.Id = inputId;
}
function nombreCliente() {
  const inputNombre = document.querySelector("#Nombre").value;
  //console.log(nombre);
  cita.Nombre = inputNombre;
}
function seleccionarFecha() {
  const inputFecha = document.querySelector("#Fecha");
  inputFecha.addEventListener("input", function (e) {
    //console.log("seleccionaste una fecha");
    const dia = new Date(e.target.value).getUTCDay();
    //console.log(dia);
    if ([6, 0].includes(dia)) {
      //console.log("no abrimos sabados ni domingos");
      e.target.value = "";
      mostrarAlerta("fines de semana no permitidos", "error", ".formulario");
    } else {
      //console.log("correcto");
      cita.Fecha = e.target.value;
    }
  });
}

function seleccionarHora() {
  const inputHora = document.querySelector("#Hora");
  inputHora.addEventListener("input", function (e) {
    //console.log(e.target.value);

    const horaCita = e.target.value;
    const hora = horaCita.split(":")[0];
    if (hora < 10 || hora > 18) {
      //console.log("cerrado");
      mostrarAlerta("Hora no valida", "error", ".formulario");
      e.target.value = "";
    } else {
      //console.log("abierto");
      cita.Hora = e.target.value;
    }
  });
}

function mostrarResumen() {
  const resumen = document.querySelector(".contenido-resumen");

  //Limpiar el Contenido de Resumen
  while (resumen.firstChild) {
    //easy
    resumen.removeChild(resumen.firstChild);
  }

  // console.log(Object.values(cita));
  // console.log(cita.servicios.length);

  if (Object.values(cita).includes("") || cita.Servicios.length === 0) {
    mostrarAlerta(
      "falta datos de servicio, Fecha u Hora",
      "error",
      ".contenido-resumen",
      false
    );
    return;
  }
  //console.log('todo bien');
  //Formatear el div de resumen
  const { Nombre, Fecha, Hora, Servicios } = cita;

  //heading para Cita
  const headingCita = document.createElement("H3");
  headingCita.textContent = "Resumen de la Cita";
  resumen.appendChild(headingCita);

  //Datos de Cita
  const nombreCliente = document.createElement("P");
  nombreCliente.innerHTML = `<span>Nombre:</span> ${Nombre}`;
  //console.log(nombreCliente);

  //Formatear la fecha en español
  const fechaObj = new Date(Fecha);
  const mes = fechaObj.getMonth();
  const dia = fechaObj.getDate() + 2; //cada vez que usamos la clase date hay un desface de 1 dia y como lo usamos 2 veces se restara 2 dias
  const year = fechaObj.getFullYear();

  const fechaUTC = new Date(Date.UTC(year, mes, dia));
  //console.log(fechaUTC);
  const opciones = {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  };
  const fechaFormateada = fechaUTC.toLocaleDateString("es-PE", opciones); //ya que es un objeto de fecha y no un String
  //console.log(fechaFormateada);

  const FechaCita = document.createElement("P");
  FechaCita.innerHTML = `<span>Fecha: </span> ${fechaFormateada}`;
  //console.log(FechaCita);

  const HoraCita = document.createElement("P");
  HoraCita.innerHTML = `<span>Hora:</span> ${Hora}`;
  //console.log(HoraCita);

  //boton para Crear una Cita
  const botonReservar = document.createElement("BUTTON");
  botonReservar.classList.add("boton-azul");
  botonReservar.textContent = "Reservar Cita";
  botonReservar.onclick = reservarCita; //dejamos asi no mas , pero si queremos pasarle un parametro tenemos que usar un function tipo callback

  //mostrando nombre fecha y hora
  resumen.appendChild(nombreCliente);
  resumen.appendChild(FechaCita);
  resumen.appendChild(HoraCita);
  resumen.appendChild(botonReservar);

  //heading para Servicios
  const headingServicios = document.createElement("H3");
  headingServicios.textContent = "Resumen de los Servicios";
  resumen.appendChild(headingServicios);
  //Iterando y mostrando los servicios
  Servicios.forEach((servicio) => {
    //servicio es un objeto
    const { Id, Nombre, Precio } = servicio;
    const contenedorServicio = document.createElement("DIV");
    contenedorServicio.classList.add("contenedor-servicio");

    const textoServicio = document.createElement("P");
    textoServicio.textContent = Nombre;

    const precioServicio = document.createElement("P");
    precioServicio.innerHTML = `<span>Precio: </span> S/.${Precio}`;

    contenedorServicio.appendChild(textoServicio);
    contenedorServicio.appendChild(precioServicio);
    resumen.appendChild(contenedorServicio);
  });
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true) {
  // Previene que se generen más de 1 alerta
  const alertaPrevia = document.querySelector(".alerta");
  if (alertaPrevia) {
    alertaPrevia.remove();
  }
  // Scripting para crear la alerta
  const alerta = document.createElement("DIV");
  alerta.textContent = mensaje;
  alerta.classList.add("alerta");
  alerta.classList.add(tipo);
  //console.log(alerta);
  //agregar la alerta
  const referencia = document.querySelector(elemento);
  referencia.appendChild(alerta);
  //quitar la alerta despues de cierto tiempo
  if (desaparece) {
    setTimeout(() => {
      alerta.remove();
    }, 3000);
  }
}

async function reservarCita() {
  const { Nombre, Hora, Fecha, Servicios, Id } = cita;
  const idServicios = Servicios.map((servicio) => servicio.Id);
  //console.log(idServicios);
  const datos = new FormData(); //Es como el submit de un formulario contendra todo los datos que queremos mandar
  datos.append("UsuarioId", Id);
  datos.append("Hora", Hora);
  datos.append("Fecha", Fecha);
  datos.append("servicios", idServicios);
  //console.log(datos); //no podemos ver el contenido
  //console.log([...datos]); //un tip para poder verlo, tomamaos una copia y lo podemos formatear

  try {
    //peticion hacia la api
    const url = `${location.origin}/api/citas`;
    const respuesta = await fetch(url, {
      //fecth debe de saber que form data existe
      method: "POST",
      body: datos,
    });
    //console.log(respuesta);
    const resultado = await respuesta.json();
    //console.log(resultado);
    if (resultado.resultado) {
      Swal.fire({
        icon: "success",
        title: "Cita Creada",
        text: "Tu cita fue creada correctamente!",
        button: "Ok",
      }).then(() => {
        setTimeout(() => {
          window.location.reload();
        }, 1500);
      });
    }
  } catch (error) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Hubo un error",
    });
  }
}
