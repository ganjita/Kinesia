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
    $('tr[data-id]').click(function() {
      // Obtén los valores de los elementos td
      var nombre = $(this).find('td.nombre').text();
      var apellido = $(this).find('td.apellido').text();
      var direccion = $(this).find('td.direccion').text();
      var osocial = $(this).find('td.osocial').text();
      var plan = $(this).find('td.plan').text();
      var nroafiliado = $(this).find('td.nroafiliado').text();
      var dni = $(this).find('td.dni').text();
      var telefono = $(this).find('td.telefono').text();
      

      var nombreCompleto = nombre + ' ' + apellido;

      // Rellena el formulario con los valores obtenidos
      $('#nombre').val(nombreCompleto);
      $('#telefono').val(dni);
      $('#direccion').val(direccion);
      $('#osocial').val(osocial);
      $('#plan').val(plan);
      $('#nroafiliado').val(nroafiliado);
      $('#telefono').val(telefono);
    });
  });
  