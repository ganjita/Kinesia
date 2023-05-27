  // Obtener el elemento input por su id
  var input = document.getElementById("fecha");
  // Obtener la fecha actual como un objeto Date
  var ahora = new Date();
  // Formatear la fecha actual como una cadena en el formato AAAA-MM-DD
  var valor = ahora.getFullYear() + "-" +
              ("0" + (ahora.getMonth() + 1)).slice(-2) + "-" +
              ("0" + ahora.getDate()).slice(-2);
  // Asignar el valor al input
  input.value = valor;

  // Función para cambiar el día del input según el parámetro delta
  function cambiarDia(delta) {
    // Obtener la fecha del input como un objeto Date
    var fecha = new Date(input.value);
    // Sumar o restar un día al objeto Date según el parámetro delta
    fecha.setDate(fecha.getDate() + delta+1);
    // Formatear la nueva fecha como una cadena en el formato AAAA-MM-DD
    var nuevoValor = fecha.getFullYear() + "-" +
                     ("0" + (fecha.getMonth() + 1)).slice(-2) + "-" +
                     ("0" + fecha.getDate()).slice(-2);
    // Asignar el nuevo valor al input
    input.value = nuevoValor;
  }

  // *********************************************************************
  //**********************************************************************
  //Script para mostrar la lista de médicos


  // Usando jQuery para seleccionar el medico de NUEVO TURNO
  // Asignar un evento click a las opciones de la lista desplegable
  $(".medicoTurnoNuevo").on("click", function(){
    // Obtener el texto de la opción seleccionada usando el método text()
    var texto = $(this).text();
    // Cambiar el texto del botón por el de la opción seleccionada usando el método text()
    var nuevoTexto = $("#medico").text(texto);
  });

  // Usando jQuery para seleccionar el medico de TURNOS MEDICO
  // Asignar un evento click a las opciones de la lista desplegable
  $(".turnoMedico").on("click", function(){
    // Obtener el texto de la opción seleccionada usando el método text()
    var texto = $(this).text();
    // Cambiar el texto del botón por el de la opción seleccionada usando el método text()
    var nuevoTexto = $("#dropdownMenuButton1").text(texto);
  });
  
  //****************************************************************
  //*************************************************************
  //script para seleccionar un paciente de la busqueda y se autocomplete el formulario de turno
  
  
  $(document).ready(function() {
    // Agrega el evento de clic a las filas de la tabla
    $('td[data-id]').click(function() {
      // Obtén el ID del paciente desde el atributo data
      var pacienteId = $(this).data('id');
      
      // Realiza una solicitud AJAX para obtener los datos del paciente según el ID
      $.ajax({
        url: 'obtener_datos_paciente.php', // Ruta al archivo PHP que obtiene los datos del paciente
        method: 'POST',
        data: { id: pacienteId }, // Envía el ID del paciente al archivo PHP
        success: function(response) {
          // Rellena el formulario con los datos del paciente
          var datosPaciente = JSON.parse(response); // Convierte la respuesta JSON a un objeto JavaScript
          
          $('#nombre').val(datosPaciente.nombre).add('#apellido').val(datosPaciente.apellido);
          $('#direccion').val(datosPaciente.direccion);
          $('#telefono').val(datosPaciente.telefono);
          $('#email').val(datosPaciente.email);
          
          // Otros campos del formulario...
        }
      });
    });
  });
  