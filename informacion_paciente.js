document.getElementById("cargar-turno").addEventListener("click", function () {
  // Obtener los datos del formulario
  var form = document.getElementById("form-agregar-turno");
  var formData = new FormData(form);

  // Crear una solicitud AJAX
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "app/buscarpacienteregturno.php", true);

  // Definir la función de callback cuando la solicitud esté completa
  xhr.onload = function () {
    if (xhr.status === 200) {
      // La solicitud se completó exitosamente
      var respuesta = xhr.responseText;
      console.log(respuesta); // Mostrar la respuesta en la consola (opcional)
    } else {
      // Hubo un error al procesar la solicitud
      console.error("Error al buscar paciente para regturno.");
    }
  };

  // Enviar la solicitud con los datos del formulario
  xhr.send(formData);
});

//////////////////////////////////////////////////////////////////////////////
///////////ABRIR LA VENTANA MODAL DE AGREGAR TURNO///////////////////////////
/////////////////////////////////////////////////////////////////////////////

// Obtener referencia al botón "Agregar Turno"
var agregarTurnoBtn = document.getElementById("agregar-turno");

// Obtener referencia a la ventana modal
var modalAgregarTurno = new bootstrap.Modal(
  document.getElementById("modal-agregar-turno")
);

// Agregar evento de clic al botón "Agregar Turno"
agregarTurnoBtn.addEventListener("click", function () {
  // Obtener el id de usuario desde el elemento con el id "id"
  var usuarioId = document.getElementById("id").textContent;

  // Establecer el valor del campo oculto "id-paciente" en el formulario
  document.getElementById("id-paciente").value = usuarioId;

  // Abrir la ventana modal utilizando Bootstrap 5
  modalAgregarTurno.show();
});

///////////////////////////////////////////////////////////////////////
///////////ENVIAR NOTAS A LA BASE DE DATOS////////////////////////////
//////////////////////////////////////////////////////////////////////

// Obtener referencia al botón "Guardar"
var guardarBtn = document.getElementById("guardar-notas");

// Agregar evento de clic al botón "Guardar"
guardarBtn.addEventListener("click", function () {
  // Obtener valores del formulario
  var fecha = document.getElementById("fecha-actual").value;
  var texto = document.getElementById("notas").value;
  var usuarioId = $("#id").text();

  console.log(usuarioId);
  console.log(texto);

  // Función para enviar los datos a la base de datos mediante una solicitud AJAX
  function enviarDatosABaseDeDatos(fecha, texto, usuarioId) {
    // Crear un objeto XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Configurar la solicitud
    xhr.open("POST", "app/guardar_notas.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Definir la función de callback cuando la solicitud esté completa
    xhr.onload = function () {
      if (xhr.status === 200) {
        // La solicitud se completó exitosamente
        var respuesta = xhr.responseText;
        alert(respuesta); // Mostrar respuesta (opcional)
        location.reload(); // Recargar la página
      } else {
        // Hubo un error al procesar la solicitud
        alert("Error al guardar los datos en la base de datos.");
      }
    };

    // Crear los datos a enviar en el cuerpo de la solicitud
    var datos =
      "fecha=" +
      encodeURIComponent(fecha) +
      "&texto=" +
      encodeURIComponent(texto) +
      "&usuarioId=" +
      encodeURIComponent(usuarioId);

    // Enviar la solicitud
    xhr.send(datos);
  }

  // Llamar a la función para enviar los datos a la base de datos
  enviarDatosABaseDeDatos(fecha, texto, usuarioId);
});

// Obtener la fecha actual y establecerla en el campo "Fecha Actual"
var fechaActual = obtenerFechaActual();
document.getElementById("fecha-actual").value = fechaActual;

// Función para obtener la fecha actual en formato yyyy-mm-dd
function obtenerFechaActual() {
  var date = new Date();
  var year = date.getFullYear();
  var month = ("0" + (date.getMonth() + 1)).slice(-2);
  var day = ("0" + date.getDate()).slice(-2);
  return year + "-" + month + "-" + day;
}

///////////////////////////////////////////////////////////////////////
////////////CARGAR IMAGENES EN LA BASE DE DATOS////////////////////////
//////////////////////////////////////////////////////////////////////

$(document).ready(function () {
  $("#btn-cargar-imagen").click(function () {
    var idUsuario = $("#id").text();
    var fileInput = $(".input-imagen")[0];
    var file = fileInput.files[0];
    var filePath = fileInput.value; // Obtener la ruta completa del archivo desde el campo de entrada
    var fileName = filePath
      ? filePath.substring(filePath.lastIndexOf("\\") + 1)
      : "";

    // Crear un objeto FormData y agregar los datos necesarios
    var formData = new FormData();
    formData.append("idUsuario", idUsuario);
    formData.append("file", file);
    formData.append("filePath", filePath); // Agregar la ruta del archivo al FormData
    formData.append("fileName", fileName); // Agregar el nombre del archivo al FormData

    // Realizar la solicitud AJAX
    $.ajax({
      url: "app/cargar_imagenes.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        // Aquí puedes realizar cualquier acción con la respuesta recibida
        alert(response); // Mostrar respuesta (opcional)
        location.reload();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        // Manejo de errores
        alert(respuesta); // Mostrar respuesta (opcional)
      },
    });
  });
});
////////////////////////////////////////////////////////////////////////////////////////////
////////////DETALLE DEL TURNO DEL USUARIO DESDE LA FICHA USUARIO///////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
$(document).ready(function () {
  // Manejar el evento de clic en las filas de la tabla
  $(document).on("click", ".fila-turno", function () {
    var fila = $(this);
    var idTurno = fila.data("id");
    var fecha = fila.find("td:nth-child(2)").text();
    var hora = fila.find("td:nth-child(3)").text();
    var medico = fila.find("td:nth-child(4)").text();
    var valor = fila.find("td:nth-child(6)").text();
    var pagado = parseInt(fila.find("td:nth-child(7)").text());

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
      "<p><strong>Valor $</strong> " +
      valor +
      "</p>";

    $("#detalleTurnoModaluser #detalleTurnoModalBodyuser").html(detalleHtml);
    $("#detalleTurnoModaluser").modal("show");

    var checkboxPagado = document.getElementById("checkboxuser2");
    var estaPagado = pagado;

    if (estaPagado) {
      checkboxPagado.checked = estaPagado === 1;
    } else {
      checkboxPagado.checked = false;
    }

    document.getElementById("turnoIdFechaUser").value = idTurno;
    document.getElementById("turnoIdHoraUser").value = idTurno;
    document.getElementById("turnoIdEliminarUser").value = idTurno;
    document.getElementById("idTurnoPadreUser").value = idTurno;
  });
});

////////////////////////////////////////////////////
// Manejar el evento de clic en "Editar Fecha"/////
///////////////////////////////////////////////////
document.addEventListener("DOMContentLoaded", function () {
  var editarFechaBtn = document.getElementById("editarFechaUserBtn");

  if (editarFechaBtn) {
    editarFechaBtn.addEventListener("click", function () {
      // Abrir el popup para editar la fecha
      $("#editarFechaModalUser").modal("show");
    });
  }
});

/////////////////////////////////////////////////////
// Manejar el evento de clic en "Editar Hora"////////
////////////////////////////////////////////////////
document.addEventListener("DOMContentLoaded", function () {
  var editarHoraBtn = document.getElementById("editarHoraUserBtn");

  if (editarHoraBtn) {
    editarHoraBtn.addEventListener("click", function () {
      // Abrir el popup para editar la hora
      $("#editarHoraModalUser").modal("show");
    });
  }
});

////////////////////////////////////////////////////////
// Manejar el evento de clic en "Intercambiar Turnos"///
///////////////////////////////////////////////////////
document.addEventListener("DOMContentLoaded", function () {
  var intercambiarTurnoBtn = document.getElementById(
    "intercambiarTurnoUserBtn"
  );

  if (intercambiarTurnoBtn) {
    intercambiarTurnoBtn.addEventListener("click", function () {
      // Abrir el popup para intercambiar el turno
      $("#cambiarTurnoModalUser").modal("show");
    });
  }
});

///////////////////////////////////////////////////////////
// Manejar el evento de clic en "actualizar pagado o no"///
//////////////////////////////////////////////////////////

document.addEventListener("DOMContentLoaded", function () {
  var actEstadoBtn = document.getElementById("actEstadoUserBtn");

  if (actEstadoBtn) {
    actEstadoBtn.addEventListener("click", function () {
      var estadocheckbox = document.getElementById("checkboxuser2").checked;
      var idTurno = document.getElementById("turnoIdFechaUser").value;

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
            timer: 1500,
          });
          // Redirigir a una página después de 3 segundos
          setTimeout(function () {
            window.location.href = "buscar_paciente.php";
          }, 1000);

          // Cerrar la ventana modal
          $("#detalleTurnoModalUser").modal("hide");
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
  var confirmarFechaBtn = document.getElementById("confirmarFechaUserBtn");

  if (confirmarFechaBtn) {
    confirmarFechaBtn.addEventListener("click", function () {
      // Obtener el valor de la nueva fecha
      var nuevaFecha = document.getElementById("nuevaFechaUser").value;

      // Obtener el ID del turno
      var idTurno = document.getElementById("turnoIdFechaUser").value;

      // Realizar la consulta para cambiar la hora_turno en la base de datos utilizando el ID del turno y la nueva hora
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "app/actualizar_hora_fecha.inc.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Fecha Actualizada!",
            showConfirmButton: false,
            timer: 1500,
          });
          // Redirigir a una página después de 3 segundos
          setTimeout(function () {
            window.location.href = "buscar_paciente.php";
          }, 1000);
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
      $("#editarFechaModalUser").modal("hide");
    });
  }
});

////////////////////////////////////////////////////
// Manejar el evento de clic en "Confirmar" (Hora)//
////////////////////////////////////////////////////

document.addEventListener("DOMContentLoaded", function () {
  var confirmarHoraBtn = document.getElementById("confirmarHoraUserBtn");

  if (confirmarHoraBtn) {
    confirmarHoraBtn.addEventListener("click", function () {
      // Obtener el valor de la nueva hora
      var nuevaHora = document.getElementById("nuevaHoraUser").value;

      // Obtener el ID del turno
      var idTurno = document.getElementById("turnoIdHoraUser").value;

      // Realizar la consulta para cambiar la hora_turno en la base de datos utilizando el ID del turno y la nueva hora
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "app/actualizar_hora_fecha.inc.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Hora Actualizada!",
            showConfirmButton: false,
            timer: 1500,
          });
          // Redirigir a una página después de 3 segundos
          setTimeout(function () {
            window.location.href = "buscar_paciente.php";
          }, 1000);
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
      $("#editarHoraModalUser").modal("hide");
    });
  }

  // Manejar el evento de cierre del popup (hidden.bs.modal)
  $("#editarFechaModalUser").on("hidden.bs.modal", function () {
    // Tu código aquí
  });
});

/////////////////////////////////////////////////////////////////////////
////////POPUP PARA ELIMINAR TURNO Y VENTANA DE CONFIRMACION//////////////
////////////////////////////////////////////////////////////////////////
document.addEventListener("DOMContentLoaded", function () {
  var eliminarTurnoBtn = document.querySelector(".btn-danger");
  var confirmarEliminacionBtn = document.getElementById(
    "confirmarEliminacionUserBtn"
  );

  if (eliminarTurnoBtn && confirmarEliminacionBtn) {
    eliminarTurnoBtn.addEventListener("click", function () {
      var confirmacionModal = new bootstrap.Modal(
        document.getElementById("confirmacionModalUser")
      );
      confirmacionModal.show();
    });

    confirmarEliminacionBtn.addEventListener("click", function () {
      var idTurno = document.getElementById("turnoIdFechaUser").value;

      var xhr = new XMLHttpRequest();
      xhr.open("POST", "app/eliminar_turno.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Turno Eliminado",
            showConfirmButton: false,
            timer: 1500,
          });
          // Redirigir a una página después de 3 segundos
          setTimeout(function () {
            window.location.href = "buscar_paciente.php";
          }, 1000);
        } else {
          console.log("Error al Eliminar el turno");
        }
      };
      xhr.send("idTurno=" + idTurno);

      var confirmacionModal = bootstrap.Modal.getInstance(
        document.getElementById("confirmacionModalUser")
      );
      confirmacionModal.hide();
    });
  }
});

/////////////////////////////////////////////////////////////////////////////////////////////
/////MANEJAR LOS DATOS DE LA VENTANA MODAL "INTERCAMBIAR TURNO"/////////////////////////////
///////////Y MOSTRARLOS EN UNA NUEVA VENTANA///////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

$(document).ready(function () {
  $("#consultarTurnosDisponibleUser").click(function () {
    // Obtener los valores de fecha y hora del formulario
    var fecha = $("#fechaIntercambioTurnoUser").val();

    // Realizar la consulta con los valores obtenidos

    // Realizar la consulta con los valores obtenidos
    $.ajax({
      url: "app/turnosintercambiofecha.php",
      type: "POST",
      data: {
        fecha: fecha,
      },
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
        $("#resultadosBusquedaUser").html(resultadosHtml);

        // Abrir el nuevo popup con los resultados de la búsqueda
        $("#resultadosModalUser").modal("show");
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
  $("#resultadosBusquedaUser").on("click", "tr", function () {
    // Obtener los datos del turno seleccionado
    var turnoId = $(this).data("idturno");
    var nombre = $(this).find("td:eq(3)").text();
    var fecha = $(this).find("td:eq(1)").text();
    var hora = $(this).find("td:eq(2)").text();
    var telefono = $(this).find("td:eq(4)").text();

    // Asignar el valor de turnoId a input oculto
    var turnoSeleccionado = document.getElementById("idTurnoSeleccionadoUser");
    turnoSeleccionado.value = turnoId;

    // Obtener el campo de entrada en la ventana modal anterior
    var campoTurnoSeleccionado = $("#campoTurnoSeleccionadoUser");

    // Agregar los datos del turno al campo de entrada
    campoTurnoSeleccionado.val(
      nombre + " - " + hora + " - " + fecha + " - Tel:" + telefono
    );

    // Cerrar la ventana modal actual
    $("#resultadosModalUser").modal("hide");
  });

  // Limpiar los datos cuando la ventana modal se oculta
  $("#detalleTurnoModalUser").on("hidden.bs.modal", function () {
    // Obtener el campo de entrada en la ventana modal anterior
    var campoTurnoSeleccionado = $("#campoTurnoSeleccionadoUser");
    var fecha = $("#fechaIntercambioTurnoUser");
    var hora = $("#horaIntercambioTurnoUser");

    // Limpiar los datos del campo de entrada
    campoTurnoSeleccionado.val("");
    fecha.val("");
    hora.val("");
  });

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //////////////////PASARLO LOS VALORES DE LOS ID DE LOS TURNOS E INTERCAMBIAR////////////////////
  /////////////////////////////LOS DATOS////////////////////////////////////////////////////////

  $("#cambiarTurnoUser").click(function () {
    // Obtener los valores de turnoSeleccionado y idTurnoPadre
    var turnoSeleccionado = $("#idTurnoSeleccionadoUser").val();
    var idTurnoPadre = $("#idTurnoPadreUser").val();

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
          timer: 1500,
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

////////////////////////////////////////////////////////////////////////////
///////MANEJA VER LAS IMAGENES DEL USUARIO EN FULL SCREEN///////////////////
///////////////////////////////////////////////////////////////////////////

// JavaScript
$(document).ready(function () {
  $(".small-image").click(function () {
    var fullscreenImageUrl = $(this).attr("src");
    $("#fullscreen-image").attr("src", fullscreenImageUrl);
    $("#fullscreen-modal").modal("show");
  });
});

//////////////////////////////////////////////////////////////////////////
/////////////MOSTRAR LAS ORDENES Y MANIPULARLAS//////////////////////////
////////////////////////////////////////////////////////////////////////

$(document).ready(function () {
  $(document).ready(function () {
    // Agregar las órdenes a la lista
    var ordenList = $("#ordenList");

    // Asignar evento click a los elementos <li> de la lista de órdenes
    ordenList.on("click", "li", function () {
      var orden = $(this).data("orden");
      mostrarDetalleOrden(orden);
    });

    // Función para mostrar el detalle de la orden en el modal
    function mostrarDetalleOrden(orden) {
      $("#ordenFecha").text(orden.fecha_orden);
      $("#ordenMedico").text(orden.medico_expedicion);
      $("#ordenKinesiologo").text(orden.kinesiologo);
      $("#ordenSesiones").text(orden.sesiones);
      $("#ordenAutorizacion").text(orden.autorizacion);
      $("#ordenFechaAutorizacion").text(orden.fecha_autorizacion);
      $("#ordenMesFacturacion").text(orden.mes_facturacion);
      $("#ordenAnioFacturacion").text(orden.anio_facturacion);
      $("#ordenSesionesRestantes").text(orden.sesiones_restantes);
      $("#ordenModal").modal("show");
    }

    // Cerrar el modal al hacer clic en el botón "Cerrar"
    $(".modal-footer button").click(function () {
      $("#ordenModal").modal("hide");
      $("#modal-agregar-turno").modal("hide");
      $("#editarPacienteModal").modal("hide");
    });
  });
});

//////////////////////////////////////////////////////////////////////////////
/////////////////ENVIAR EL FORMULARIO CREAR ORDEN DESDE FICHA PACIENTE////////
/////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////
////////////ENVIAR EL FORMULARIO DE CREACION DE ORDEN MODAL//////////////////////
////////////////////////////////////////////////////////////////////////////////
$(document).ready(function () {
  $("#kinesiologoOrdenModal").change(function () {
    var selectedOptionValue = $(this).val();
    $("#idMedicoSeleccionadoOrdenModal").val(selectedOptionValue);
  });
});
$(document).ready(function () {
    $("#crearOrdenButtonModal").click(function () {

    var fechaOrden = $("#fechaOrdenModal").val();
    var medicoOrden = $("#medicoOrdenModal").val();
    var kinesiologoOrden = $("#idMedicoSeleccionadoOrdenModal").val();
    var sesionesOrden = $("#sesionesOrdenModal").val();
    var autorizacionOrden = $("#autorizacionOrdenModal").val();
    var fechaAutorizacionOrden = $("#fechaAutorizacionOrdenModal").val();
    var mesFacturacion = $("#mesFacturacionOrdenModal").val();
    var anioFacturacion = $("#anioFacturacionOrdenModal").val();
    var idUsuarioOrden = $("#id_usuario_orden_modal").val();

    // Crear el objeto formData
    var formData = new FormData();
    formData.append("fechaOrden", fechaOrden);
    formData.append("medicoOrden", medicoOrden);
    formData.append("kinesiologoOrden", kinesiologoOrden);
    formData.append("sesionesOrden", sesionesOrden);
    formData.append("autorizacionOrden", autorizacionOrden);
    formData.append("fechaAutorizacionOrden", fechaAutorizacionOrden);
    formData.append("mesFacturacion", mesFacturacion);
    formData.append("anioFacturacion", anioFacturacion);
    formData.append("idUsuarioOrden", idUsuarioOrden);

    var inputImagen = document.getElementById("imagenOrdenModal");
    var file = inputImagen.files[0];
    formData.append("imagenOrdenModal", file);

    // Envío de la solicitud AJAX
    $.ajax({
      url: "app/crear_orden.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        // Mostrar un alert
        Swal.fire({
          icon: "success",
          title: "Todo OK!",
          text: response,
          showConfirmButton: true, // Ocultar el botón "OK"
        }).then(function () {
          // Cerrar la alerta y realizar la acción de actualizar la página y borrar los datos del formulario
          location.reload();
          $("#crearOrdenFormModal")[0].reset();
        });
      },
      error: function (xhr, status, error) {
        // Manejo de errores
        alert("Ups, Hay algun error").error(error);
      },
    });
  });
});
