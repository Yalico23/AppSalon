document.addEventListener("DOMContentLoaded", function () {
  IniciarApp();
});

function IniciarApp() {
  buscaFecha();
}

function buscaFecha() {
  const btn = document.querySelector(".btn-buscar");
  // const fechaInput = document.querySelector("#Fecha");
  // const busqueda = document.querySelector(".busqueda");
  // const alerta = document.createElement("P");
  // alerta.classList.add("boton-gris");
  // alerta.textContent = "Buscando 4";

  // fechaInput.addEventListener("input", function (e) {
  //     busqueda.appendChild(alerta);

  //     let tiempoRestante = 3;

  //     const temporizador = setInterval(() => {
  //       alerta.textContent = "Buscando "+tiempoRestante.toString();
  //       tiempoRestante--;

  //       if (tiempoRestante < 0) {
  //         clearInterval(temporizador);
  //         actualizar(e);
  //       }
  //     }, 1000);
  //   });

  btn.addEventListener("click", function () {
    actualizar();
  });
}

function actualizar() {//aqui le quite el e
  // const fechaInput = document.querySelector("#Fecha");
  // const fechaSeleccionada = e.target.value;
  // console.log(fechaSeleccionada);

  // window.location = `?fecha=${fechaSeleccionada}`;
  
  const fechaInput = document.querySelector("#Fecha");
  const fechaSeleccionada = fechaInput.value;
  window.location = `?fecha=${fechaSeleccionada}`;
}

