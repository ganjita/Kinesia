// Obtén la ruta de la página actual

// Obtener el elemento input por su id
var input = document.getElementById("fecha");

// Verificar si los datos están disponibles
if (typeof fecha !== "undefined" && fecha !== null) {
  // Obtener la fecha actual como un objeto Date
  var ahora = new Date();
  // Formatear la fecha actual como una cadena en el formato AAAA-MM-DD
  var valor =
    ahora.getFullYear() +
    "-" +
    ("0" + (ahora.getMonth() + 1)).slice(-2) +
    "-" +
    ("0" + ahora.getDate()).slice(-2);
  // Asignar el valor al input
  input.value = valor;
}

// Función para cambiar el día del input según el parámetro delta
function cambiarDia(delta) {
  // Obtener la fecha del input como un objeto Date
  var fecha = new Date(input.value);
  // Sumar o restar un día al objeto Date según el parámetro delta
  fecha.setDate(fecha.getDate() + delta);
  // Formatear la nueva fecha como una cadena en el formato AAAA-MM-DD
  var nuevoValor =
    fecha.getFullYear() +
    "-" +
    ("0" + (fecha.getMonth() + 1)).slice(-2) +
    "-" +
    ("0" + fecha.getDate()).slice(-2);
  // Asignar el nuevo valor al input
  input.value = nuevoValor;
}

/////////////////////////////////////////////////////////////////////////////////////////////////
//script para seleccionar un paciente de la busqueda y se autocomplete el formulario de turno////
/////////////////////////////////////////////////////////////////////////////////////////////////
document.addEventListener("DOMContentLoaded", function () {
  // Verificar la ruta de la página actual
  if (window.location.pathname === "/kinesia/nuevo_turno.php") {
    $(document).ready(function () {
      // Agrega el evento de clic a las filas de la tabla
      $("tr[data-id]").click(function () {
        // Obtén los valores de los elementos td
        var idPaciente = $(this).find("td.id_usuario").text();
        var nombre = $(this).find("td.nombre").text();
        var apellido = $(this).find("td.apellido").text();
        var direccion = $(this).find("td.direccion").text();
        var osocial = $(this).find("td.osocial").text();
        var plan = $(this).find("td.plan").text();
        var nroafiliado = $(this).find("td.nroafiliado").text();
        var dni = $(this).find("td.dni").text();
        var telefono = $(this).find("td.telefono").text();

        var nombreCompleto = nombre + " " + apellido;

        // Rellena el formulario con los valores obtenidos
        $("#id-paciente").val(idPaciente);
        $("#nombre").val(nombreCompleto);
        $("#telefono").val(dni);
        $("#direccion").val(direccion);
        $("#osocial").val(osocial);
        $("#plan").val(plan);
        $("#nroafiliado").val(nroafiliado);
        $("#telefono").val(telefono);

        // Realizar una solicitud AJAX al archivo PHP para recuperar las ordenes por el id_usuario
        $.ajax({
          url: "app/recuperar_orden.inc.php", // Verifica la ruta correcta del archivo PHP
          method: "POST",
          data: { id_usuario: idPaciente },
          success: function (response) {
            // Crear un elemento <select> con el contenido HTML devuelto
            var selectElement = $(response);

            // Vaciar el contenido actual del contenedor div
            $("#ordenContainer").empty();

            // Agregar el elemento <select> al contenedor <div>
            $("#ordenContainer").append(selectElement);

            console.log("BIEN");
          },
          error: function () {
            // Manejar el error en caso de que la solicitud falle
          },
        });
      });
    });
  }
});
//////////////////////////////////////////////////////////////////////////////
////////GUARDAR EL ID DE LA ORDEN CUANDO SE SELECCIONA EN INPUT OCULTO///////
/////////////////////////////////////////////////////////////////////////////

$(document).ready(function() {
  // Manejar el evento de cambio en el select
  $(document).on("change", "#orden", function() {
    // Obtener el valor seleccionado del select
    var valorSeleccionado = $(this).val();
    

    // Actualizar el valor del input oculto
    $("#idOrdenSeleccionada").val(valorSeleccionado);
  });
});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//SELECCIONAR EL MEDICO DEL DROPDOWN EN NUEVO TURNO Y ENVIAR EL TEXTO DEL DROPDOWN PARA LA BASE DE DATOS/////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

$(document).ready(function () {
  $(".dropdown-menu button").click(function () {
    var medicoId = $(this).attr("data-value");
    var medicoNombre = $(this).text();

    $("#medicoSeleccionado").val(medicoNombre);
    $("#medico").text(medicoNombre);
    $("#idMedicoSeleccionado").val(medicoId);

    $(this).closest(".dropdown-menu").removeClass("show");
  });
});

/////////////////////////////////////////////////////////////////////////////////
//OBTENER EL VALOR DEL DROPDOWN EN TURNOS POR MEDICO Y PROCESAR EL FORMULARIO////
/////////////////////////////////////////////////////////////////////////////////

// Esperar a que se cargue el DOM
document.addEventListener("DOMContentLoaded", function () {
  var medicoButton = document.getElementById("medico");

  // Verificar si el botón existe
  if (medicoButton) {
    medicoButton.addEventListener("click", function (event) {
      event.preventDefault(); // Evitar la acción predeterminada del botón

      // Mostrar el menú desplegable al hacer clic en el botón
      this.nextElementSibling.classList.toggle("hidden");
    });
  }
});

////////////////////////////////////////////////////////////////////
/////CLICK EN LA FILA DE LOS TURNOS Y SE ABRE LA VENTANA POPUP/////
///////////////////////////////////////////////////////////////////

// Esperar a que se cargue el DOM
$(document).ready(function () {
  // Verificar si el elemento que deseas bloquear existe
  var fila = document.getElementById("fila-bloqueada");

  // Verificar si la condición se cumple para cargar el código
  if (fila) {
    // Manejar el evento de clic en la fila
    fila.addEventListener("click", function (event) {
      // Detener la propagación del evento
      event.stopPropagation();
    });

    // Obtener la tabla y el cuerpo de la tabla
    var tabla = document.querySelector(".table");
    var tablaBody = document.getElementById("resultadoTurnos");

    // Agregar el evento de clic a las filas generadas dinámicamente
    $(tabla).on("click", "tr", function () {
      var fila = $(this);
      if (fila) {
        // Obtener los datos de la fila
        var medico = fila.find("td:nth-child(1)").text();
        var fecha = fila.find("td:nth-child(2)").text();
        var hora = fila.find("td:nth-child(3)").text();
        var paciente = fila.find("td:nth-child(4)").text();
        var telefono = fila.find("td:nth-child(5)").text();
        var obraSocial = fila.find("td:nth-child(6)").text();
        var plan = fila.find("td:nth-child(7)").text();
        var nroAfiliado = fila.find("td:nth-child(8)").text();
        var valor = fila.find("td:nth-child(9)").text();
        var pagado = parseInt(fila.find("td:nth-child(10)").text());
        var id_usuario = fila.find("td:nth-child(11)").text();

        // Construir el contenido del detalle del turno
        var detalleHtml =
          "<p><strong>Médico:</strong> " +
          medico +
          "</p>" +
          "<p><strong>Fecha:</strong> " +
          fecha +
          "</p>" +
          "<p><strong>Hora:</strong> " +
          hora +
          "</p>" +
          "<p><strong>Paciente:</strong> " +
          paciente +
          "</p>" +
          "<p><strong>Teléfono:</strong> " +
          telefono +
          "</p>" +
          "<p><strong>O.Social:</strong> " +
          obraSocial +
          "</p>" +
          "<p><strong>Plan:</strong> " +
          plan +
          "</p>" +
          "<p><strong>Nro.Afiliado:</strong> " +
          nroAfiliado +
          "</p>" +
          "<p><strong>Valor $</strong> " +
          valor +
          "</p>";

        ///////////////ANALIZA EL ESTADO DEL CHECKBOX PARA MOSTRARLO TILDADO O NO///////////////////

        var checkboxPagado = document.getElementById("checkbox2");
        var estaPagado = pagado;

        if (estaPagado) {
          // El checkbox está marcado
          // Establecer el estado del checkbox según el valor obtenido
          checkboxPagado.checked = estaPagado === 1; // Asigna true si valorPagado es 1, false en caso contrario
        } else {
          // El checkbox está desmarcado
          checkboxPagado.checked = false;
        }

        // Insertar el contenido del detalle del turno en el modal
        $("#detalleTurnoModalBody").html(detalleHtml);

        // Obtener el ID del turno
        var idTurno = fila.attr("data-idturno");

        // Establecer el ID del turno en los campos ocultos de los popups para utilizarlo en la base de datos
        $("#turnoIdFecha").val(idTurno);
        $("#turnoIdHora").val(idTurno);
        $("#turnoIdEliminar").val(idTurno);
        $("#idTurnoPadre").val(idTurno);
        $("#idUsuarioFila").val(id_usuario);

        // Abrir el modal
        $("#detalleTurnoModal").modal("show");
      }
    });
  }
});

////////////////////////////////////////////////////
// Manejar el evento de clic en "Editar Fecha"/////
///////////////////////////////////////////////////
document.addEventListener("DOMContentLoaded", function () {
  var editarFechaBtn = document.getElementById("editarFechaBtn");

  if (editarFechaBtn) {
    editarFechaBtn.addEventListener("click", function () {
      // Abrir el popup para editar la fecha
      $("#editarFechaModal").modal("show");
    });
  }
});

/////////////////////////////////////////////////////
// Manejar el evento de clic en "Editar Hora"////////
////////////////////////////////////////////////////
document.addEventListener("DOMContentLoaded", function () {
  var editarHoraBtn = document.getElementById("editarHoraBtn");

  if (editarHoraBtn) {
    editarHoraBtn.addEventListener("click", function () {
      // Abrir el popup para editar la hora
      $("#editarHoraModal").modal("show");
    });
  }
});

////////////////////////////////////////////////////////
// Manejar el evento de clic en "Intercambiar Turnos"///
///////////////////////////////////////////////////////
document.addEventListener("DOMContentLoaded", function () {
  var intercambiarTurnoBtn = document.getElementById("intercambiarTurnoBtn");

  if (intercambiarTurnoBtn) {
    intercambiarTurnoBtn.addEventListener("click", function () {
      // Abrir el popup para intercambiar el turno
      $("#cambiarTurnoModal").modal("show");
    });
  }
});

///////////////////////////////////////////////////////////
// Manejar el evento de clic en "actualizar pagado o no"///
//////////////////////////////////////////////////////////

document.addEventListener("DOMContentLoaded", function () {
  var actEstadoBtn = document.getElementById("actEstadoBtn");

  if (actEstadoBtn) {
    actEstadoBtn.addEventListener("click", function () {
      var estadocheckbox = document.getElementById("checkbox2").checked;
      var idTurno = document.getElementById("turnoIdFecha").value;

      console.log(estadocheckbox);
      console.log(idTurno);

      var xhr = new XMLHttpRequest();
      xhr.open("POST", "app/actualizar_check_estado.inc.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          console.log(xhr.responseText);
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Estado Actualizado!",
            showConfirmButton: false,
            timer: 3000,
          });

          // Cerrar la ventana modal
          $("#detalleTurnoModal").modal("hide");
        } else {
          console.log("Error al ejecutar la consulta");
        }
      };
      xhr.send(
        "checkboxstatus=" +
          encodeURIComponent(estadocheckbox ? 1 : 0) +
          "&idTurno=" +
          encodeURIComponent(idTurno)
      );
    });
  }
});

///////////////////////////////////////////////////////
// Manejar el evento de clic en "Confirmar" (Fecha)////
//////////////////////////////////////////////////////

document.addEventListener("DOMContentLoaded", function () {
  var confirmarFechaBtn = document.getElementById("confirmarFechaBtn");

  if (confirmarFechaBtn) {
    confirmarFechaBtn.addEventListener("click", function () {
      // Obtener el valor de la nueva fecha
      var nuevaFecha = document.getElementById("nuevaFecha").value;

      // Obtener el ID del turno
      var idTurno = document.getElementById("turnoIdFecha").value;

      // Realizar la consulta para cambiar la hora_turno en la base de datos utilizando el ID del turno y la nueva hora
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "app/actualizar_hora_fecha.inc.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // La consulta se ejecutó correctamente
          console.log(xhr.responseText);
        } else {
          // Error al ejecutar la consulta
          console.log("Error al actualizar la hora");
        }
      };
      xhr.send(
        "nuevaFecha=" +
          encodeURIComponent(nuevaFecha) +
          "&idTurno=" +
          encodeURIComponent(idTurno)
      );

      // Cerrar el popup
      $("#editarFechaModal").modal("hide");
    });
  }
});

////////////////////////////////////////////////////
// Manejar el evento de clic en "Confirmar" (Hora)//
////////////////////////////////////////////////////

document.addEventListener("DOMContentLoaded", function () {
  var confirmarHoraBtn = document.getElementById("confirmarHoraBtn");

  if (confirmarHoraBtn) {
    confirmarHoraBtn.addEventListener("click", function () {
      // Obtener el valor de la nueva hora
      var nuevaHora = document.getElementById("nuevaHora").value;

      // Obtener el ID del turno
      var idTurno = document.getElementById("turnoIdHora").value;

      // Realizar la consulta para cambiar la hora_turno en la base de datos utilizando el ID del turno y la nueva hora
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "app/actualizar_hora_fecha.inc.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // La consulta se ejecutó correctamente
          console.log(xhr.responseText);
        } else {
          // Error al ejecutar la consulta
          console.log("Error al actualizar la hora");
        }
      };
      xhr.send(
        "nuevaHora=" +
          encodeURIComponent(nuevaHora) +
          "&idTurno=" +
          encodeURIComponent(idTurno)
      );

      // Cerrar el popup
      $("#editarHoraModal").modal("hide");
    });
  }

  // Manejar el evento de cierre del popup (hidden.bs.modal)
  $("#editarFechaModal").on("hidden.bs.modal", function () {
    // Tu código aquí
  });
});
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///     CIERRE DE VENTANAS MODAL Y SOMBRAS DE FONDO SOLUCION NO PODER ABRIR 2 VECES UN MISMO BOTON    /////
///////////////////////////////////////////////////////////////////////////////////////////////////////////

// Obtener los botones que abren las ventanas modales
var openButtons = document.querySelectorAll("[data-bs-toggle='modal']");

// Asignar un evento de clic a cada botón que abre una ventana modal
openButtons.forEach(function (button) {
  button.addEventListener("click", function () {
    // Obtener el ID de la ventana modal a abrir
    var targetModalId = button.getAttribute("data-bs-target");
    var targetModal = document.querySelector(targetModalId);

    // Abrir la ventana modal
    var modal = new bootstrap.Modal(targetModal);
    modal.show();

    // Agregar la clase "modal-open" al elemento <body>
    document.body.classList.add("modal-open");
  });
});

// Obtener todos los botones de cerrar
var closeButtons = document.querySelectorAll(".btn-close");

// Asignar un evento de clic a cada botón de cerrar
closeButtons.forEach(function (button) {
  button.addEventListener("click", function () {
    // Obtener el modal correspondiente al botón de cerrar
    var modal = button.closest(".modal");

    // Cerrar la ventana modal
    var bsModal = bootstrap.Modal.getInstance(modal);
    bsModal.hide();

    // Si es la ventana principal, no eliminar la sombra
    if (modal.getAttribute("id") !== "detalleTurnoModal") {
      return;
    }

    // Eliminar la clase "modal-open" del elemento <body>
    document.body.classList.remove("modal-open");

    // Eliminar el estilo de fondo oscurecido aplicado por Bootstrap
    var modalBackdrops = document.getElementsByClassName("modal-backdrop");
    for (var i = 0; i < modalBackdrops.length; i++) {
      modalBackdrops[i].parentNode.removeChild(modalBackdrops[i]);
    }
  });
});

/////////////////////////////////////////////////////////////////////////
////////POPUP PARA ELIMINAR TURNO Y VENTANA DE CONFIRMACION//////////////
////////////////////////////////////////////////////////////////////////
document.addEventListener("DOMContentLoaded", function () {
  var eliminarTurnoBtn = document.querySelector(".btn-danger");
  var confirmarEliminacionBtn = document.getElementById(
    "confirmarEliminacionBtn"
  );

  if (eliminarTurnoBtn && confirmarEliminacionBtn) {
    eliminarTurnoBtn.addEventListener("click", function () {
      var confirmacionModal = new bootstrap.Modal(
        document.getElementById("confirmacionModal")
      );
      confirmacionModal.show();
    });

    confirmarEliminacionBtn.addEventListener("click", function () {
      var idTurno = document.getElementById("turnoIdFecha").value;

      var xhr = new XMLHttpRequest();
      xhr.open("POST", "app/eliminar_turno.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          console.log(xhr.responseText);
        } else {
          console.log("Error al Eliminar el turno");
        }
      };
      xhr.send("idTurno=" + idTurno);

      var confirmacionModal = bootstrap.Modal.getInstance(
        document.getElementById("confirmacionModal")
      );
      confirmacionModal.hide();
    });
  }
});

////////////////////////////////////////////////////////////////////////////////////////////////
/////////CONSULTAR LA BASE DE DATOS SEGUN EL DIA SELECCIONADO EN EL INPUTFECHA/////////////////
////////////////////////DE LA PAGINA TURNOS_MEDICO.PHP////////////////////////////////////////
$(document).ready(function () {
  // Obtener el elemento de fecha y médico
  var fechaElement = $("#fecha");
  var medicoDropdown = $(".medicoTurnoNuevo"); // Obtener los elementos del dropdown con la clase "medicoTurnoNuevo"
  var medicoButton = $("#medico"); // Obtener el botón del dropdown con el id "medico"

  // Función para realizar la solicitud Ajax y actualizar la interfaz
  function realizarConsulta() {
    var fecha = fechaElement.val();
    var medico = medicoButton.attr("data-value"); // Obtener el valor del atributo "data-value" del botón principal

    // Verificar si se ha seleccionado un médico
    if (!medico) {
      return; // Salir de la función sin realizar la consulta
    }

    // Realizar la solicitud Ajax
    $.ajax({
      url: "app/obtenerturnosmedico1.php",
      type: "POST",
      data: { fecha: fecha, medico: medico }, // Corregir el orden de los parámetros
      dataType: "html",
      success: function (response) {
        // Actualizar la interfaz con los resultados obtenidos
        $("#resultadoTurnos").html(response);
      },
      error: function (xhr, status, error) {
        // Manejar errores de la solicitud Ajax
        console.log(xhr.responseText);
      },
    });
  }

  // Asignar el evento click a los elementos <li> del dropdown
  medicoDropdown.closest("li").on("click", function (event) {
    event.preventDefault(); // Prevenir el comportamiento predeterminado del evento

    // Obtener el valor y el texto del elemento seleccionado
    var medicoValue = $(this).find(".medicoTurnoNuevo").attr("data-value");
    var medicoText = $(this).find(".medicoTurnoNuevo").text();

    // Actualizar el valor del input oculto y el texto del botón del dropdown
    $(".medicoSeleccionado").val(medicoText);
    $("#idMedicoSeleccionado").val(medicoValue);
    medicoButton.text(medicoText);
    medicoButton.attr("data-value", medicoValue); // Actualizar el atributo data-value del botón principal

    realizarConsulta();
  });

  // Asignar el evento change al elemento de fecha
  fechaElement.on("change", function () {
    realizarConsulta();
  });

  // Obtener la fecha actual como un objeto Date
  var ahora = new Date();
  // Formatear la fecha actual como una cadena en el formato AAAA-MM-DD
  var valor =
    ahora.getFullYear() +
    "-" +
    ("0" + (ahora.getMonth() + 1)).slice(-2) +
    "-" +
    ("0" + ahora.getDate()).slice(-2);
  // Asignar el valor al input de fecha
  fechaElement.val(valor);

  // Llamar a realizarConsulta() al cargar la página para obtener los resultados iniciales
  realizarConsulta();

  // Obtener los botones de día anterior y día siguiente
  var botonAnterior = $("#anterior");
  var botonSiguiente = $("#siguiente");

  // Asignar el evento click a los botones
  botonAnterior.on("click", function (e) {
    e.preventDefault();
    var fechaAnterior = restarDia(fechaElement.val());
    fechaElement.val(fechaAnterior);
    realizarConsulta();
  });

  botonSiguiente.on("click", function (e) {
    e.preventDefault();
    var fechaSiguiente = sumarDia(fechaElement.val());
    fechaElement.val(fechaSiguiente);
    realizarConsulta();
  });

  // Función para restar un día a una fecha en formato YYYY-MM-DD
  function restarDia(fecha) {
    var fechaActual = new Date(fecha);
    fechaActual.setDate(fechaActual.getDate() - 1);
    return fechaActual.toISOString().split("T")[0];
  }

  // Función para sumar un día a una fecha en formato YYYY-MM-DD
  function sumarDia(fecha) {
    var fechaActual = new Date(fecha);
    fechaActual.setDate(fechaActual.getDate() + 1);
    return fechaActual.toISOString().split("T")[0];
  }
});

/////////////////////////////////////////////////////////////////////////////////////////////
/////MANEJAR LOS DATOS DE LA VENTANA MODAL "INTERCAMBIAR TURNO"/////////////////////////////
///////////Y MOSTRARLOS EN UNA NUEVA VENTANA///////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

$(document).ready(function () {
  $("#consultarTurnosDisponible").click(function () {
    // Obtener los valores de fecha y hora del formulario
    var fecha = $("#fechaIntercambioTurno").val();

    // Realizar la consulta con los valores obtenidos

    // Realizar la consulta con los valores obtenidos
    $.ajax({
      url: "app/turnosintercambiofecha.php",
      type: "POST",
      data: { fecha: fecha },
      dataType: "html",
      success: function (response) {
        // Generar los resultados de la búsqueda y asignarlos a resultadosHtml
        // Aquí puedes agregar lógica para construir el contenido de resultadosHtml con los datos recibidos en la respuesta
        var resultadosHtml =
          '<table class="table table-striped table-hover">' +
          "<thead>" +
          "<tr>" +
          "<th>Medico</th>" +
          "<th>Fecha</th>" +
          "<th>Hora</th>" +
          "<th>Nombre</th>" +
          "<th>Teléfono</th>" +
          "<th>Obra Social</th>" +
          "<th>Plan</th>" +
          "<th>Nro Afiliado</th>" +
          "</tr>" +
          "</thead>" +
          "<tbody>" +
          response + // Aquí se incluye el contenido de response sin formato
          "</tbody>" +
          "</table>";
        // Agregar los resultados al elemento "resultadosBusqueda"
        $("#resultadosBusqueda").html(resultadosHtml);

        // Abrir el nuevo popup con los resultados de la búsqueda
        $("#resultadosModal").modal("show");
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
      },
    });
  });

  ////////////////////////////////////////////////////////////////////////////////////
  ///////////SELECCIONAR EL TURNO DE LA LISTA PARA INTERCAMBIAR Y PASAR DATOS/////////
  ///////////////////////////////////////////////////////////////////////////////////
  // Capturar el clic en una fila de la tabla de resultados
  $("#resultadosBusqueda").on("click", "tr", function () {
    // Obtener los datos del turno seleccionado
    var turnoId = $(this).data("idturno");
    var nombre = $(this).find("td:eq(3)").text();
    var fecha = $(this).find("td:eq(1)").text();
    var hora = $(this).find("td:eq(2)").text();
    var telefono = $(this).find("td:eq(4)").text();

    // Asignar el valor de turnoId a input oculto
    var turnoSeleccionado = document.getElementById("idTurnoSeleccionado");
    turnoSeleccionado.value = turnoId;

    // Obtener el campo de entrada en la ventana modal anterior
    var campoTurnoSeleccionado = $("#campoTurnoSeleccionado");

    // Agregar los datos del turno al campo de entrada
    campoTurnoSeleccionado.val(
      nombre + " - " + hora + " - " + fecha + " - Tel:" + telefono
    );

    // Cerrar la ventana modal actual
    $("#resultadosModal").modal("hide");
  });

  // Limpiar los datos cuando la ventana modal se oculta
  $("#detalleTurnoModal").on("hidden.bs.modal", function () {
    // Obtener el campo de entrada en la ventana modal anterior
    var campoTurnoSeleccionado = $("#campoTurnoSeleccionado");
    var fecha = $("#fechaIntercambioTurno");
    var hora = $("#horaIntercambioTurno");

    // Limpiar los datos del campo de entrada
    campoTurnoSeleccionado.val("");
    fecha.val("");
    hora.val("");
  });

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //////////////////PASARLO LOS VALORES DE LOS ID DE LOS TURNOS E INTERCAMBIAR////////////////////
  /////////////////////////////LOS DATOS////////////////////////////////////////////////////////

  $("#cambiarTurno").click(function () {
    // Obtener los valores de turnoSeleccionado y idTurnoPadre
    var turnoSeleccionado = $("#idTurnoSeleccionado").val();
    var idTurnoPadre = $("#idTurnoPadre").val();

    // Crear el objeto de datos a enviar
    var data = {
      idTurnoSeleccionado: turnoSeleccionado,
      idTurnoPadre: idTurnoPadre,
    };

    // Realizar la solicitud AJAX
    $.ajax({
      url: "app/intercambiarturnoporotro.php",
      type: "POST",
      data: data,
      success: function (response) {
        // Manejar la respuesta del servidor
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Intercambio Exitoso! =)",
          showConfirmButton: false,
          timer: 3000,
        });

        // Realizar las acciones necesarias en caso de éxito
        window.close();
      },
      error: function (xhr, status, error) {
        // Manejar el error en caso de fallo en la solicitud
        console.log("Error en la solicitud: " + error);
        // Realizar las acciones necesarias en caso de error
      },
    });
  });
});

///////////////////////////////////////////////////////////////////////////////////////////
////////////CLICK EN LA FILA DE PACIENTES BUSCADOS PARA MOSTRAR TODA LA FICHA//////////////
//////////////////////////////////////////////////////////////////////////////////////////

document.addEventListener("DOMContentLoaded", function () {
  if (window.location.pathname === "/kinesia/buscar_paciente.php") {
    // Verificar si el elemento que deseas bloquear existe
    var fila = document.getElementById("fila-usuariosBloqueada");

    // Verificar si la condición se cumple para cargar el código
    if (fila) {
      // Manejar el evento de clic en la fila
      fila.addEventListener("click", function (event) {
        // Detener la propagación del evento
        event.stopPropagation();
      });

      // Obtener la tabla y el cuerpo de la tabla
      var tabla = document.querySelector(".table");
      var tablaBody = document.getElementById("resultadoUsuarios");

      // Agregar el evento de clic a las filas generadas dinámicamente
      tabla.addEventListener("click", function (event) {
        var fila = event.target.closest("tr");

        if (fila) {
          // Obtener el ID del paciente de la fila
          var pacienteId = fila.getAttribute("data-id");

          // Crear un objeto con los datos a enviar
          var data = {
            id: pacienteId,
          };

          // Realizar la solicitud AJAX al servidor para enviar los datos
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "app/buscar_pacienteapp.php", true);
          xhr.setRequestHeader("Content-type", "application/json");
          xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
              // Aquí puedes manejar la respuesta del servidor

              // Redirigir a la página "informacionpaciente.php"
              window.location.href = "informacionpaciente.php";
            }
          };
          xhr.send(JSON.stringify(data));
        }
      });
    }
  }
});

//////////////////////////////////////////////////////////////////////////////
////////BUSCAR LA FICHA DEL PACIENTE DESDE EL MODAL DE TURNO/////////////////
/////////////////////////////////////////////////////////////////////////////

$(document).ready(function () {
  // Evento click del botón "Ficha del Paciente"
  $("#fichaDelPaciente").on("click", function () {
    // Obtener el ID del paciente
    var pacienteId = document.getElementById("idUsuarioFila").value;

    // Realizar la solicitud Ajax
    var data = {
      id: pacienteId,
    };

    // Realizar la solicitud AJAX al servidor para enviar los datos
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "app/buscar_pacienteapp.php", true);
    xhr.setRequestHeader("Content-type", "application/json");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Aquí puedes manejar la respuesta del servidor
        console.log(xhr.responseText);
        // Redirigir a la página "informacionpaciente.php"
        window.location.href = "informacionpaciente.php";
      }
    };
    xhr.send(JSON.stringify(data));
  });
});

///////////////////////////////////////////////////////////////////////////////
///////////////RECUPERAR ORDENES DEL USUARIO PASADO POR ID////////////////////
/////////////////////////////////////////////////////////////////////////////
