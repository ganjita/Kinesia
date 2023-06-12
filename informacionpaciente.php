<?php
include_once 'plantillas/navmenu.inc.php';

session_start();

function convertirValorPagado($valor)
{
    if ($valor == 0) {
        return "No";
    } elseif ($valor == 1) {
        return "Si";
    } else {
        return "Valor inválido";
    }
}

if (isset($_SESSION['datosUsuarios']) && isset($_SESSION['datosTurnos'])) {
    $datosUsuario = $_SESSION['datosUsuarios'];

    // Datos de los turnos
    $datosTurnos = $_SESSION['datosTurnos'];

    // Extraer los datos de usuario
    $id = $datosUsuario[0]['id'];
    $nombre = $datosUsuario[0]['nombre'];
    $apellido = $datosUsuario[0]['apellido'];
    $dni = $datosUsuario[0]['dni'];
    $direccion = $datosUsuario[0]['direccion'];
    $localidad = $datosUsuario[0]['localidad'];
    $telefono = $datosUsuario[0]['telefono'];
    $fecha_nacimiento = $datosUsuario[0]['fecha_nacimiento'];
    $obra_social = $datosUsuario[0]['obra_social'];
    $nroafiliado = $datosUsuario[0]['nroafiliado'];
    $plan = $datosUsuario[0]['plan'];
    $mail = $datosUsuario[0]['mail'];
    $fecha_alta = $datosUsuario[0]['fecha_alta'];
}
?>

<div class="container">
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Información Personal
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>ID de Usuario:</th>
                                    <td id="id"><?php echo $id; ?></td>
                                </tr>
                                <tr>
                                    <th>Nombre:</th>
                                    <td id="nombre"><?php echo $nombre; ?></td>
                                </tr>
                                <tr>
                                    <th>Apellido:</th>
                                    <td id="apellido"><?php echo $apellido; ?></td>
                                </tr>
                                <tr>
                                    <th>DNI:</th>
                                    <td id="dni"><?php echo $dni; ?></td>
                                </tr>
                                <tr>
                                    <th>Dirección:</th>
                                    <td id="direccion"><?php echo $direccion; ?></td>
                                </tr>
                                <tr>
                                    <th>Localidad:</th>
                                    <td id="localidad"><?php echo $localidad; ?></td>
                                </tr>
                                <tr>
                                    <th>Teléfono:</th>
                                    <td id="telefono"><?php echo $telefono; ?></td>
                                </tr>
                                <tr>
                                    <th>Fecha de Nacimiento:</th>
                                    <td id="fecha_nacimiento"><?php echo $fecha_nacimiento; ?></td>
                                </tr>
                                <tr>
                                    <th>Edad:</th>
                                    <td id="edad"><?php
                                                    $fechaActual = new DateTime();
                                                    $fecha_nacimiento = new DateTime($fecha_nacimiento);
                                                    $edad = $fecha_nacimiento->diff($fechaActual)->y;
                                                    echo $edad . " " . "Años"; ?></td>
                                </tr>
                                <tr>
                                    <th>Obra Social:</th>
                                    <td id="obra_social"><?php echo $obra_social; ?></td>
                                </tr>
                                <tr>
                                    <th>Nro de Afiliado:</th>
                                    <td id="nroafiliado"><?php echo $nroafiliado; ?></td>
                                </tr>
                                <tr>
                                    <th>Plan:</th>
                                    <td id="plan"><?php echo $plan; ?></td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td id="mail"><?php echo $mail; ?></td>
                                </tr>
                                <tr>
                                    <th>Fecha de Alta:</th>
                                    <td id="fecha_alta"><?php echo $fecha_alta; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarPacienteModal">Editar Información Paciente</button>
                        <div class="modal fade" id="editarPacienteModal" tabindex="-1" aria-labelledby="editarPacienteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editarPacienteModalLabel">Editar Información del Paciente</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Contenido del formulario de edición -->
                                        <form>
                                            <!-- Campos del formulario -->
                                            <div class="mb-3">
                                                <label for="nombre" class="form-label">Direccion</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre">
                                            </div>
                                            <div class="mb-3">
                                                <label for="apellido" class="form-label">Localidad</label>
                                                <input type="text" class="form-control" id="apellido" name="apellido">
                                            </div>
                                            <!-- Campos del formulario -->
                                            <div class="mb-3">
                                                <label for="nombre" class="form-label">Telefono</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre">
                                            </div>
                                            <div class="mb-3">
                                                <label for="apellido" class="form-label">Obra Social</label>
                                                <input type="text" class="form-control" id="apellido" name="apellido">
                                            </div>
                                            <!-- Campos del formulario -->
                                            <div class="mb-3">
                                                <label for="nombre" class="form-label">Nro Afiliado</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre">
                                            </div>
                                            <div class="mb-3">
                                                <label for="apellido" class="form-label">Plan</label>
                                                <input type="text" class="form-control" id="apellido" name="apellido">
                                            </div>
                                            <div class="mb-3">
                                                <label for="apellido" class="form-label">Email</label>
                                                <input type="text" class="form-control" id="apellido" name="apellido">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary">Guardar cambios</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Turnos
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID Turno</th>
                                    <th>Fecha del Turno</th>
                                    <th>Hora del Turno</th>
                                    <th>Médico</th>
                                    <th>Motivo</th>
                                    <th>Valor</th>
                                    <th>Pagado</th>
                                </tr>
                            </thead>
                            <tbody id="turnos-body">
                                <?php
                                if (isset($datosTurnos)) {
                                    // Número de resultados por página
                                    $resultadosPorPagina = 6;
                                    // Obtener el número total de turnos
                                    $totalTurnos = count($datosTurnos);
                                    // Calcular el número total de páginas
                                    $totalPaginas = ceil($totalTurnos / $resultadosPorPagina);
                                    // Obtener el número de página actual
                                    $paginaActual = isset($_GET['page']) ? $_GET['page'] : 1;
                                    // Calcular el índice inicial y final de los resultados en la página actual
                                    $indiceInicio = ($paginaActual - 1) * $resultadosPorPagina;
                                    $indiceFin = $indiceInicio + $resultadosPorPagina;
                                    // Obtener los turnos para la página actual
                                    $turnosPagina = array_slice($datosTurnos, $indiceInicio, $resultadosPorPagina);
                                    // Mostrar los turnos de la página actual
                                    if (count($turnosPagina) > 0) {
                                        foreach ($turnosPagina as $turno) {
                                            $id_turno = $turno['id_turno'];
                                            $id_usuario = $turno['id_usuario'];
                                            $fechaTurno = $turno['fecha_turno'];
                                            $horaTurno = $turno['hora_turno'];
                                            $medico = $turno['medico'];
                                            $motivo = $turno['motivo'];
                                            $valor = $turno['valor'];
                                            $pagado = $turno['pagado'];
                                            // Generar una fila con los datos del turno
                                            echo "<tr data-id='" . $id_turno . "'>";
                                            echo "<td>" . $id_turno . "</td>";
                                            echo "<td>" . $fechaTurno . "</td>";
                                            echo "<td>" . $horaTurno . "</td>";
                                            echo "<td>" . $medico . "</td>";
                                            echo "<td>" . $motivo . "</td>";
                                            echo "<td>" . $valor . "</td>";
                                            echo "<td hidden>" . $pagado . "</td>";
                                            echo "<td>" . convertirValorPagado($pagado) . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {

                                        echo "<tr>  No se encontraron Turnos</tr>";
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td>No se encontraron Turnos</td>";
                                    echo "</tr>";
                                }
                                // Mostrar los enlaces de paginación
                                echo "<nav aria-label='Pagination'>";
                                echo "<ul class='pagination'>";
                                // Enlace a la página anterior
                                if ($paginaActual > 1) {
                                    echo "<li class='page-item'><a class='page-link' href='informacionpaciente.php?page=" . ($paginaActual - 1) . "'>&laquo;</a></li>";
                                } else {
                                    echo "<li class='page-item disabled'><a class='page-link' href='#'>&laquo;</a></li>";
                                }
                                // Enlaces a las páginas
                                for ($i = 1; $i <= $totalPaginas; $i++) {
                                    if ($i == $paginaActual) {
                                        echo "<li class='page-item active'><a class='page-link' href='#'>" . $i . "</a></li>";
                                    } else {
                                        echo "<li class='page-item'><a class='page-link' href='informacionpaciente.php?page=" . $i . "'>" . $i . "</a></li>";
                                    }
                                }
                                // Enlace a la página siguiente
                                if ($paginaActual < $totalPaginas) {
                                    echo "<li class='page-item'><a class='page-link' href='informacionpaciente.php?page=" . ($paginaActual + 1) . "'>&raquo;</a></li>";
                                } else {
                                    echo "<li class='page-item disabled'><a class='page-link' href='#'>&raquo;</a></li>";
                                }
                                echo "</ul>";
                                echo "</nav>";
                                ?>
                            </tbody>
                        </table>
                        <!-- Ventana popup -->
                        <div class="modal fade" id="detalleTurnoModaluser" tabindex="-1" role="dialog" aria-labelledby="detalleTurnoModaluserLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" id="cerrarmodaluser">
                                        <h5 class="modal-title" id="detalleTurnoModaluserLabel">Detalles del Turno</h5>
                                        <button type="button" class="btn-close close" id="closeuser" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                        <input type="int" id="idTurnoFilauser" name="idTurnoFilauser" hidden>
                                    </div>
                                    <div class="modal-body" id="detalleTurnoModalBodyuser">
                                        <!-- Contenido del detalle del turno -->
                                    </div>
                                    <div class="form-check form-check-inline d-flex align-items-center justify-content-center">
                                        <input class="form-check-input" type="checkbox" id="checkboxuser2" style="margin-left: 3px;" ;>
                                        <label class=" form-check-label" for="checkboxuser2" style="margin-left: 3px;">ESTA PÁGO (tilda para marcar que esta pagado)</label>
                                        <button type="button" class="btn btn-success" id="actEstadoBtnuser">Actualizar estado de pago</button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="intercambiarTurnoBtnuser">Intercambiar Turno por otro</button>
                                        <button type="button" class="btn btn-primary" id="editarFechaBtnuser">Editar Fecha</button>
                                        <button type="button" class="btn btn-primary" id="editarHoraBtnuser">Editar Hora</button>
                                        <button type="button" class="btn btn-danger" id="eliminarTurnoBtnuser">Eliminar Turno</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="pagination"></div> <!-- Contenedor para los botones de paginación -->
                </div>
            </div>
        </div>
    </div>

    <div class="row-mt-4" style="margin-top: 10px;">
        <div class="col-md-12">
            <!-- Columna 1 -->
            <div class="card">
                <div class="card-header">
                    Imágenes
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row" id="image-grid">
                            <?php
                            if (isset($_SESSION['datosImg'])) {
                                $datosImg = $_SESSION['datosImg'];
                                foreach ($datosImg as $img) {
                                    $imagen_id = $img["id"];
                                    $imagen_nombre = $img["nombre_archivo"];

                                    // Obtener los datos de la imagen desde la base de datos
                                    $imagen_data = $img["imagen"];

                                    // Generar el formato de la etiqueta <img> con la imagen codificada en base64
                                    $imagen_base64 = base64_encode($imagen_data);
                                    $imagen_src = 'data:image/jpeg;base64,' . $imagen_base64;

                                    // Mostrar la imagen en la etiqueta <img> con una clase para identificarla
                                    echo '<div class="col-md-4">
                                              <img src="' . $imagen_src . '" alt="' . $imagen_nombre . '" class="img-thumbnail small-image">
                                        </div>';
                                }
                            } else {
                                echo "No se encontraron imágenes para este usuario.";
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Contenedor para mostrar la imagen en pantalla completa -->
                    <div id="fullscreen-image-container">
                        <img id="fullscreen-image" src="" alt="">
                        <button id="close-fullscreen-image" class="btn btn-danger">Cerrar</button>
                    </div>
                    <input type="file" class="form-control input-imagen" style="margin-top: 6px;">
                    <button id="btn-cargar-imagen" class="btn btn-primary" style="margin-top: 6px;">Cargar Imagen</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4" style="margin-top: 10px;">
        <div class="col-md-6" style="margin-top: 10px;">
            <!-- Columna 2 -->
            <div class="card">
                <div class="card-header">
                    Caja-Cliente
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="saldo-deudor">Saldo Deudor: ($)</label>
                        <?php
                        $cuenta = 0;
                        if (isset($datosTurnos)) {
                            foreach ($datosTurnos as $turno) {
                                $pagado = $turno['pagado'];
                                if (convertirValorPagado($pagado) == 'No') {
                                    $valorTurno = $turno['valor'];
                                    $cuenta += $valorTurno;
                                }
                            }
                        }
                        ?>
                        <input type="text" class="form-control" id="saldo-deudor" readonly value="<?php echo $cuenta ?>">
                    </div>
                    <div class="form-group">
                        <label for="entrega-parcial">Entrega Parcial: ($)</label>
                        <input type="text" class="form-control" id="entrega-parcial">
                    </div>
                    <div class="form-group">
                        <label for="anotacion-entrega">Anotación:</label>
                        <textarea class="form-control" id="anotacion-entrega" rows="3"></textarea>
                    </div>
                    <button class="btn btn-primary" style="margin-top: 10px;">Realizar Entrega</button>
                </div>
            </div>
        </div>
        <div class="col-md-6" style="margin-top: 10px;">
            <!-- Columna 3 -->
            <div class="card">
                <div class="card-header">
                    Notas
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="fecha-actual">Fecha Actual:</label>
                        <input type="text" class="form-control" id="fecha-actual" disabled>
                    </div>
                    <div class="form-group">
                        <label for="notas">Notas:</label>
                        <textarea class="form-control" id="notas" rows="5"></textarea>
                    </div>
                    <button class="btn btn-primary" style="margin-top: 10px;">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
///////////////////////////////////////////////////////////////////////
////////////CARGAR IMAGENES EN LA BASE DE DATOS////////////////////////
//////////////////////////////////////////////////////////////////////

    $(document).ready(function() {
        $('#btn-cargar-imagen').click(function() {
            var idUsuario = $("#id").text();
            var fileInput = $('.input-imagen')[0];
            var file = fileInput.files[0];
            var filePath = fileInput.value; // Obtener la ruta completa del archivo desde el campo de entrada
            var fileName = filePath ? filePath.substring(filePath.lastIndexOf('\\') + 1) : '';

            // Crear un objeto FormData y agregar los datos necesarios
            var formData = new FormData();
            formData.append('idUsuario', idUsuario);
            formData.append('file', file);
            formData.append('filePath', filePath); // Agregar la ruta del archivo al FormData
            formData.append('fileName', fileName); // Agregar el nombre del archivo al FormData

            // Realizar la solicitud AJAX
            $.ajax({
                url: 'app/cargar_imagenes.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Aquí puedes realizar cualquier acción con la respuesta recibida
                    console.log('Respuesta del servidor:', response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Manejo de errores
                    console.error('Error:', textStatus, errorThrown);
                }
            });
        });
    });
////////////////////////////////////////////////////////////////////////////////////////////
////////////DETALLE DEL TURNO DEL USUARIO DESDE LA FICHA USUARIO///////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

    $(document).ready(function() {
        // Agregar evento de clic a las filas de la tabla
        $('tbody#turnos-body tr').click(function() {
            var fila = $(this);
            console.log(fila);

            // Verificar si la condición se cumple para cargar el código
            if (fila) {
                // Manejar el evento de clic en la fila
                fila.on("click", function(event) {
                    // Detener la propagación del evento
                    event.stopPropagation();
                });

                // Obtener los datos de la fila
                var fecha = fila.find("td:eq(1)").text();
                var hora = fila.find("td:eq(2)").text();
                var medico = fila.find("td:eq(3)").text();
                var valor = fila.find("td:eq(5)").text();
                var pagado = parseInt(fila.find("td:eq(6)").text());

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
                    "<p><strong>Valor $</strong> " +
                    valor +
                    "</p>";

                // Mostrar los detalles del turno en el modal
                $('#detalleTurnoModaluser .modal-body').html(detalleHtml);
                // Abrir el modal
                $('#detalleTurnoModaluser').modal('show');

                ///////////////ANALIZA EL ESTADO DEL CHECKBOX PARA MOSTRARLO TILDADO O NO///////////////////

                var checkboxPagado = document.getElementById("checkboxuser2");
                var estaPagado = pagado;

                if (estaPagado) {
                    // El checkbox está marcado
                    // Establecer el estado del checkbox según el valor obtenido
                    checkboxPagado.checked = estaPagado === 1; // Asigna true si valorPagado es 1, false en caso contrario
                } else {
                    // El checkbox está desmarcado
                    checkboxPagado.checked = false;
                }
            }
        });
    });
////////////////////////////////////////////////////////////////////////////
///////MANEJA VER LAS IMAGENES DEL USUARIO EN FULL SCREEN///////////////////
///////////////////////////////////////////////////////////////////////////

    $(document).ready(function() {
        // Agregar un evento de clic a cada imagen
        $('.small-image').click(function() {
            // Obtener la URL de la imagen grande
            var fullscreenImageUrl = $(this).attr('src');

            // Mostrar la imagen en pantalla completa con transición
            $('#fullscreen-image').attr('src', fullscreenImageUrl);
            $('#fullscreen-image-container').fadeIn();
        });

        // Cerrar la imagen en pantalla completa al hacer clic en el botón "Cerrar" o fuera de la imagen
        $('#close-fullscreen-image, #fullscreen-image-container').click(function(e) {
            if (e.target !== this) {
                return;
            }
            $('#fullscreen-image-container').fadeOut();
        });
    });
</script>



<?php
// Limpiar las variables de sesión después de mostrar los datos
include_once 'plantillas/footer.inc.php';
include_once 'plantillas/cierrehtml.inc.php';
?>