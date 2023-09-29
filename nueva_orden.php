<?php
include_once 'plantillas/navmenu.inc.php';
include_once 'app/recuperarmedico.inc.php';
?>
<div class="container">
    <form id="crearOrdenForm" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <label for="buscarUsuario" class="form-label">Buscar Usuario:</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="buscarUsuario" placeholder="Ingrese nombre o apellido (respeta acentos)">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="nombreApellido" class="form-label">Nombre y Apellido del paciente:</label>
                <input type="text" class="form-control" id="nombreApellido" readonly>
            </div>
            <div class="col-md-6">
                <label for="fechaOrden" class="form-label">Fecha de la Orden:</label>
                <input type="date" class="form-control" id="fechaOrden">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="medicoOrden" class="form-label">Médico que ordenó:</label>
                <input type="text" class="form-control" id="medicoOrden">
            </div>
            <div class="col-md-6">
                <label for="kinesiologoOrden" class="form-label">Kinesiólogo asignado:</label>
                <select class="form-select" id="kinesiologoOrden">
                    <option value="">Seleccionar Kinesiólogo</option>
                    <?php foreach ($medicos as $medico) { ?>
                        <option value="<?php echo $medico['id']; ?>"><?php echo $medico['nombre'] . ' ' . $medico['apellido']; ?></option>
                    <?php } ?>
                </select>
                <input type="hidden" class="idMedicoSeleccionadoOrden" id="idMedicoSeleccionadoOrden" name="idMedicoSeleccionadoOrden" value="<?php echo $medico['id']; ?>">
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="sesionesOrden" class="form-label">Cantidad de Sesiones:</label>
                <input type="number" class="form-control" id="sesionesOrden">
            </div>
            <div class="col-md-6">
                <label for="obraSocialOrden" class="form-label">Obra Social:</label>
                <input type="text" class="form-control" id="obraSocialOrden" disabled>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="autorizacionOrden" class="form-label">Autorización:</label>
                <input type="text" class="form-control" id="autorizacionOrden">
            </div>
            <div class="col-md-6">
                <label for="fechaAutorizacionOrden" class="form-label">Fecha de Autorización:</label>
                <input type="date" class="form-control" id="fechaAutorizacionOrden">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="mesFacturacion" class="form-label">Mes de Facturación:</label>
                <select class="form-select" id="mesFacturacion">
                    <option value="">Seleccionar mes</option>
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="anioFacturacion" class="form-label">Año de Facturación:</label>
                <input type="text" class="form-control" id="anioFacturacion">
            </div>
        </div>

        <form>
            <div class="mb-3">
                <label for="imagen" class="form-label">Adjuntar foto de la imagen:</label>
                <input type="file" class="form-control" id="imagen">
            </div>
        </form>
        <input type="hidden" id="id_usuario_orden" name="idUsuarioOrden">
        <button type="submit" class="btn btn-primary enviarOrden mt-3">Crear Orden</button>
    </form>
</div>

<style>
    .ui-autocomplete {
        max-height: 200px;
        overflow-y: auto;
        background-color: #333342;
        /* Color de fondo deseado */
        color: white;
        border: 1px solid #ccc;
        /* Borde deseado */
        padding: 5px;
        /* Espaciado interno deseado */
        width: 15%;

    }

    .ui-autocomplete li {
        list-style: none;
        /* Quitar viñetas de la lista */
        padding: 5px;
        /* Espaciado interno deseado para cada elemento de la lista */
    }
</style>


<script>
    $(document).ready(function() {
        // Configurar el evento keyup para el campo de búsqueda
        $("#buscarUsuario").on("keyup", function() {
            // Obtener el término de búsqueda
            var term = $(this).val();

            // Realizar la solicitud AJAX al servidor
            $.ajax({
                url: "app/recuperar_usuario_orden.php", // Reemplaza con la ruta correcta al archivo PHP de búsqueda
                method: "GET",
                data: {
                    term: term
                },
                dataType: "json",
                success: function(response) {
                    // Actualizar el autocompletado con los resultados obtenidos
                    actualizarAutocompletado(response);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        // Función para actualizar el autocompletado con los resultados
        function actualizarAutocompletado(usuarios) {
            // Configurar el autocompletado con los usuarios obtenidos
            $("#buscarUsuario").autocomplete({
                source: usuarios.map(function(usuario) {
                    return {
                        label: usuario.apellido + " " + usuario.nombre + " - DNI: " + usuario.dni + " - Obra Social: " + usuario.obra_social,
                        value: usuario.apellido + " " + usuario.nombre,
                        id: usuario.id,
                        obra_social: usuario.obra_social
                    };
                }),
                select: function(event, ui) {
                    // Actualizar otros campos con los datos del usuario seleccionado
                    $("#nombreApellido").val(ui.item.value);
                    $("#obraSocialOrden").val(ui.item.obra_social);
                    $("#id_usuario_orden").val(ui.item.id);
                }
            });
        }

    });

    //////////////////////////////////////////////////////////////////////////////////
    ////////////ENVIAR EL FORMULARIO DE CREACION DE ORDEN////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////
    $(document).ready(function() {
        $('#kinesiologoOrden').change(function() {
            var selectedOptionValue = $(this).val();
            $('#idMedicoSeleccionadoOrden').val(selectedOptionValue);

        });
    });
    $(document).ready(function() {
    $('.enviarOrden').click(function(event) {
        event.preventDefault();

        // Obtener los valores de los campos
        var fechaOrden = $('#fechaOrden').val();
        var medicoOrden = $('#medicoOrden').val();
        var kinesiologoOrden = $('#idMedicoSeleccionadoOrden').val();
        var sesionesOrden = $('#sesionesOrden').val();
        var autorizacionOrden = $('#autorizacionOrden').val();
        var fechaAutorizacionOrden = $('#fechaAutorizacionOrden').val();
        var mesFacturacion = $('#mesFacturacion').val();
        var anioFacturacion = $('#anioFacturacion').val();
        var idUsuarioOrden = $('#id_usuario_orden').val();

        // Validar que todos los campos estén completos
        if (fechaOrden && medicoOrden && kinesiologoOrden && sesionesOrden && autorizacionOrden && fechaAutorizacionOrden && mesFacturacion && anioFacturacion && idUsuarioOrden){
            // Crear el objeto formData
            var formData = new FormData();
            formData.append('fechaOrden', fechaOrden);
            formData.append('medicoOrden', medicoOrden);
            formData.append('kinesiologoOrden', kinesiologoOrden);
            formData.append('sesionesOrden', sesionesOrden);
            formData.append('autorizacionOrden', autorizacionOrden);
            formData.append('fechaAutorizacionOrden', fechaAutorizacionOrden);
            formData.append('mesFacturacion', mesFacturacion);
            formData.append('anioFacturacion', anioFacturacion);
            formData.append('idUsuarioOrden', idUsuarioOrden);

            var inputImagen = document.getElementById('imagen');
            var file = inputImagen.files[0];
            formData.append('imagen', file);

            // Envío de la solicitud AJAX
            $.ajax({
                url: 'app/crear_orden.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Mostrar un alert
                    Swal.fire({
                        icon: 'success',
                        title: 'Todo OK!',
                        text: response,
                        showConfirmButton: true,
                    }).then(function() {
                        // Cerrar la alerta y realizar la acción de actualizar la página y borrar los datos del formulario
                        location.reload();
                        $('#crearOrdenForm')[0].reset();
                    });
                },
                error: function(xhr, status, error) {
                    // Manejo de errores
                    alert('Ups, Hay algun error').error(error);
                }
            });
        } else {
            // Mostrar un mensaje de error si no se completaron todos los campos
            alert('Por favor, complete todos los campos del formulario.');
        }
    });
});



</script>

<?php
include_once 'plantillas/cierrehtml.inc.php';
?>