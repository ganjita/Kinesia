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
  //****************************************************************
  //*************************************************************
  //script para seleccionar un paciente de la busqueda y se autocomplete el formulario de turno
  
  $(document).ready(function() {
    // Agrega el evento de clic a las filas de la tabla
    $('tr[data-id]').click(function() {
      // Obtén los valores de los elementos td
      var idPaciente = $(this).find('td.id_usuario').text();
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
      $('#id-paciente').val(idPaciente)
      $('#nombre').val(nombreCompleto);
      $('#telefono').val(dni);
      $('#direccion').val(direccion);
      $('#osocial').val(osocial);
      $('#plan').val(plan);
      $('#nroafiliado').val(nroafiliado);
      $('#telefono').val(telefono);
    });
  });

  //******************************************************* */
  //******************************************************** */
  //******************************************************** */
  //SELECCIONAR EL MEDICO DEL DROPDOWN EN NUEVO TURNO Y ENVIAR EL TEXTO DEL DROPDOWN PARA LA BASE DE DATOS

  $(document).ready(function() {
    $('.dropdown-menu a').click(function() {
      var medicoId = $(this).data('value'); // Obtén el valor de data-value
      var medicoNombre = $(this).text(); // Obtén el texto del elemento seleccionado
  
      $('#medicoSeleccionado').val(medicoNombre); // Asigna el nombre al campo oculto
      $('#medico').text(medicoNombre); // Actualiza el texto del botón dropdown
    });
  });

  //******************************************************* */
  //******************************************************** */
  //******************************************************** */
  //OBTENER EL VALOR DEL DROPDOWN EN TURNOS POR MEDICO Y PROCESAR EL FORMULARIO

  var medicoButton = document.getElementById('medico');

  medicoButton.addEventListener('click', function(event) {
      event.preventDefault(); // Evitar la acción predeterminada del botón
  
      // Mostrar el menú desplegable al hacer clic en el botón
      this.nextElementSibling.classList.toggle('show');
  });
  
  // Agregar evento de clic a los elementos del menú desplegable
  var medicoItems = document.querySelectorAll('.medicoTurnoNuevo');
  
  medicoItems.forEach(function(item) {
      item.addEventListener('click', function() {
          // Obtener el valor seleccionado del elemento del menú desplegable
          var medicoSeleccionado = this.textContent;
  
          // Establecer el valor seleccionado en el campo oculto del formulario
          var medicoSeleccionadoInput = document.getElementById('medicoSeleccionado');
          medicoSeleccionadoInput.value = medicoSeleccionado;
  
          // Enviar el formulario
          document.getElementById('formMedico').submit();
      });
  });
  
  
  
  
  