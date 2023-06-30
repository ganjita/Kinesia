<?php
include_once 'plantillas/navmenu.inc.php';
include_once 'app/obtener_notas.inc.php';
include_once 'app/recuperarmedico.inc.php';


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
                        <button id="agregar-turno" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-agregar-turno">Agregar Turno</button>

                        <!-- Ventana modal agregar turno-->
                        <div id="modal-agregar-turno" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="modal-agregar-turnoLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Agregar Turno</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form-agregar-turno" action="procesar_turno.php" method="POST">
                                            <input type="hidden" name="id-paciente" id="id-paciente" value="">
                                            <div class="mb-3">
                                                <label for="fecha" class="form-label">Fecha del Turno:</label>
                                                <input type="date" class="form-control" name="fecha" id="fecha" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="hora" class="form-label">Hora del Turno:</label>
                                                <input type="time" class="form-control" name="hora" id="hora" required>
                                            </div>
                                            <select class="form-select" name="medico-cargarturno" id="medico-cargarturno" required>
                                                <option value="">Seleccionar Médico</option>
                                                <?php foreach ($medicos as $medico) { ?>
                                                    <option value="<?php echo $medico['id']; ?>"><?php echo $medico['nombre'] . ' ' . $medico['apellido']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <input type="hidden" id="idMedico-cargarTurno" name="idMedico-cargarTurno">
                                            <div class="mb-3">
                                                <label for="motivo" class="form-label">Motivo:</label>
                                                <textarea class="form-control" name="motivo-cargarturno" id="motivo-cargarturno" rows="4" required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="valor-consulta" class="form-label">Valor: $</label>
                                                <input type="number" class="form-control" name="valor-consulta" id="valor-consulta" required>
                                            </div>
                                            <div class="mb-3 form-check">
                                                <input type="checkbox" class="form-check-input" name="checkpagoturno" id="checkpagoturno">
                                                <label class="form-check-label" for="checkpagoturno">¿Pago del Turno?</label>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" id="cargar-turno">Agregar Turno</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ventana modal Editar Informacion -->

                        <div class="modal fade" id="editarPacienteModal" tabindex="-1" aria-labelledby="editarPacienteModalLabel" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editarPacienteModalLabel">Editar Información del Paciente</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                        <!-- Botón de cierre de la ventana modal -->
                                        <button type="button" class="btn btn-primary" id="guardarCambios">Guardar cambios</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
                                            echo "<tr data-id='" . $id_turno . "' class='fila-turno'>";
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
                                    <div class="modal-header">
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
                                        <button type="button" class="btn btn-success" id="actEstadoUserBtn">Actualizar estado de pago</button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="intercambiarTurnoUserBtn">Intercambiar Turno por otro</button>
                                        <button type="button" class="btn btn-primary" id="editarFechaUserBtn">Editar Fecha</button>
                                        <button type="button" class="btn btn-primary" id="editarHoraUserBtn">Editar Hora</button>
                                        <button type="button" class="btn btn-danger" id="eliminarTurnoUserBtn">Eliminar Turno</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Popup para editar la fecha -->
                        <div class="modal fade" id="editarFechaModalUser" tabindex="-1" role="dialog" aria-labelledby="editarFechaModalUserLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content bg-info">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editarFechaModalUserLabel">Editar Fecha</h5>
                                        <button type="button" class="btn-close close" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="date" id="nuevaFechaUser" class="form-control">
                                        <input type="hidden" id="turnoIdFechaUser">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="confirmarFechaUserBtn">Confirmar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Popup para editar la hora -->
                        <div class="modal fade" id="editarHoraModalUser" tabindex="-1" role="dialog" aria-labelledby="editarHoraModalUserLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editarHoraModalUserLabel">Editar Hora</h5>
                                        <button type="button" class="btn-close close" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="time" id="nuevaHoraUser" class="form-control">
                                        <input type="hidden" id="turnoIdHoraUser">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="confirmarHoraUserBtn">Confirmar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Popup para Intercambiar turno -->
                        <div class="modal fade" id="cambiarTurnoModalUser" tabindex="-1" role="dialog" aria-labelledby="cambiarTurnoModalUserLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="popupModalUserLabel">Intercambiar turno por otro que este en que fecha y hora? (Tiene que ser exacto):</h5>
                                        <button type="button" class="btn-close close" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="popupForm">
                                            <div class="mb-3">
                                                <label for="fecha" class="form-label">Fecha:</label>
                                                <input type="date" class="form-control" id="fechaIntercambioTurnoUser" required>
                                            </div>
                                            <div class="mb-3">
                                                <br>
                                                <label for="cambioTurno" class="form-label">El turno actual se cambiara por el siguiente:</label>
                                                <input type="hidden" id="idTurnoSeleccionadoUser" name="idTurnoSeleccionadoUser">
                                                <input type="hidden" id="idTurnoPadreUser" name="idTurnoPadreUser">
                                                <input type="text" class="form-control" id="campoTurnoSeleccionadoUser" placeholder="Turno por el que se hara el cambio" readonly>
                                            </div>
                                            <button type="button" class="btn btn-primary" id="consultarTurnosDisponibleUser">Consultar</button>
                                            <button type="button" class="btn btn-success" id="cambiarTurnoUser">Cambiar Turno</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Popup para mostrar los resultados de la búsqueda -->
                        <div class="modal fade" id="resultadosModalUser" tabindex="-1" role="dialog" aria-labelledby="resultadosModalUserLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="resultadosModalUserLabel">Resultados de la búsqueda</h5>
                                        <button type="button" class="btn-close close" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" id="resultadosBusquedaUser">
                                        <!-- Aquí se mostrarán los resultados de la búsqueda -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ventana de confirmación -->
                        <div class="modal fade" id="confirmacionModalUser" tabindex="-1" role="dialog" aria-labelledby="confirmacionModalUserLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmacionModalUserLabel">Confirmar Eliminación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estás seguro de que deseas eliminar el turno?
                                    </div>
                                    <input type="hidden" id="turnoIdEliminarUser">

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-danger" id="confirmarEliminacionUserBtn">Confirmar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="pagination">
                        <!-- Contenedor para los botones de paginación -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row-mt-4" style="margin-top: 10px;">
        <div class="col-md-12">
            <!-- Columna 1 -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Imágenes</h5>
                    <button class="btn btn-sm btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#image-card-body" aria-expanded="false" aria-controls="image-card-body">Ocultar/Mostrar</button>
                </div>
                <div id="image-card-body" class="card-body collapse">
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
                </div>
            </div>

            <!-- Contenedor para mostrar la imagen en pantalla completa -->
            <div class="modal fade" id="fullscreen-modal" tabindex="-1" aria-labelledby="fullscreen-modal-label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <img src="" alt="" id="fullscreen-image" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container card-header">
                <input type="file" class="form-control input-imagen" style="margin-top: 6px;">
                <button id="btn-cargar-imagen" class="btn btn-primary" style="margin-top: 6px;">Cargar Imagen</button>
            </div>
        </div>
    </div>

    <div class="row mt-4" style="margin-top: 10px;">
        <div class="col-md-4" style="margin-top: 10px;">
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
                        <label for="anotacion-entrega">Anotación:</label>
                        <input class="form-control" id="anotacion-entrega">
                    </div>
                    <button class="btn btn-primary" style="margin-top: 10px;">Realizar Entrega</button>
                </div>
            </div>
        </div>

        <div class="col-md-8" style="margin-top: 10px;">
            <!-- Columna 4 -->
            <div class="card">
                <div class="card-header">
                    Ordenes
                </div>
                <div class="card-body">
                    <!-- Lista de órdenes -->
                    <ul id="ordenList" class="list-group">
                        <?php
                        if (isset($_SESSION['datosOrdenes'])) {
                            $datosOrdenes = $_SESSION['datosOrdenes'];
                            foreach ($datosOrdenes as $orden) {
                                echo '<li class="list-group-item" data-orden="' . htmlspecialchars(json_encode($orden)) . '">' . "(Fecha) -" . " " .  $orden['fecha_orden'] . ' ' . "- (Medico que ordeno:) " . $orden['medico_expedicion'] . " " . " - (Sesiones restantes:) " .  $orden['sesiones_restantes'] . '</li>';
                            }
                        } else {
                            echo '<li class="list-group-item">No se encontraron órdenes</li>';
                        }
                        ?>
                    </ul>

                    <!-- Modal de detalle de la orden -->
                    <div class="modal fade" id="ordenModal" tabindex="-1" role="dialog" aria-labelledby="ordenModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ordenModalLabel">Detalle de la Orden</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="modal-body">
                                            <p><strong>Fecha de la Orden:</strong>
                                                <br>
                                                <span id="ordenFecha"></span>
                                            </p>
                                            <p><strong>Médico que la pidió:</strong>
                                                <br>
                                                <span id="ordenMedico"></span>
                                            </p>
                                            <p><strong>Kinesiólogo asignado:</strong>
                                                <br>
                                                <span id="ordenKinesiologo"></span>
                                            </p>
                                            <p><strong>Cantidad de Sesiones:</strong>
                                                <br>
                                                <span id="ordenSesiones"></span>
                                            </p>
                                            <p><strong>Autorización:</strong>
                                                <br>
                                                <span id="ordenAutorizacion"></span>
                                            </p>
                                            <p><strong>Fecha de Autorización:</strong>
                                                <br>
                                                <span id="ordenFechaAutorizacion"></span>
                                            </p>
                                            <p><strong>Mes de facturacion:</strong>
                                                <br>
                                                <span id="ordenMesFacturacion"></span>
                                            </p>
                                            <p><strong>Año de Facturacion:</strong>
                                                <br>
                                                <span id="ordenAnioFacturacion"></span>
                                            </p>
                                            <p><strong>Sesiones Restantes:</strong>
                                                <br>
                                                <span id="sesionesRestantes"></span>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <img src="img/ordenej.jpg" class="img-fluid" alt="Imagen" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-3" id="crear-orden" data-bs-toggle="modal" data-bs-target="#crearOrdenModal">Crear Orden</button>
                </div>
            </div>
        </div>

        <!-- Modal para crear una nueva orden -->
        <div class="modal fade" id="crearOrdenModal" tabindex="-1" role="dialog" aria-labelledby="crearOrdenModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearOrdenModalLabel">Crear Orden</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <form id="crearOrdenFormModal" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="fechaOrdenModal" class="form-label">Fecha de la Orden:</label>
                                <input type="date" class="form-control" id="fechaOrdenModal" name="fechaOrdenModal">
                            </div>
                            <div class="mb-3">
                                <label for="medicoOrdenModal" class="form-label">Medico que ordeno:</label>
                                <input type="text" class="form-control" id="medicoOrdenModal" name="medicoOrdenModal">
                            </div>
                            <div>
                                <select class="form-select" id="kinesiologoOrdenModal" name="kinesiologoOrdenModal">
                                    <option value="">Seleccionar Médico</option>
                                    <?php foreach ($medicos as $medico) { ?>
                                        <option value="<?php echo $medico['id']; ?>"><?php echo $medico['nombre'] . ' ' . $medico['apellido']; ?></option>
                                    <?php } ?>
                                </select>
                                <input type="hidden" class="medicoSeleccionadoOrdenModal" id="medicoSeleccionadoOrdenModal" name="medicoSeleccionadoOrdenModal">
                                <input type="hidden" class="idMedicoSeleccionadoOrdenModal" id="idMedicoSeleccionadoOrdenModal" name="idMedicoSeleccionadoOrdenModal">
                            </div>

                            <div class="mb-3">
                                <label for="sesionesOrdenModal" class="form-label">Cantidad de Sesiones:</label>
                                <input type="number" class="form-control" id="sesionesOrdenModal" name="sesionesOrdenModal">
                            </div>
                            <div class="mb-3">
                                <label for="autorizacionOrdenModal" class="form-label">Autorización:</label>
                                <input type="text" class="form-control" id="autorizacionOrdenModal" name="autorizacionOrdenModal">
                            </div>
                            <div class="mb-3">
                                <label for="fechaAutorizacionOrdenModal" class="form-label">Fecha de Autorización:</label>
                                <input type="date" class="form-control" id="fechaAutorizacionOrdenModal" name="fechaAutorizacionOrdenModal">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="mesFacturacionOrdenModal" class="form-label">Mes de Facturación:</label>
                                    <select class="form-select" id="mesFacturacionOrdenModal">
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
                                    <label for="anioFacturacionOrdenModal" class="form-label">Año de Facturación:</label>
                                    <input type="text" class="form-control" id="anioFacturacionOrdenModal">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="imagenOrdenModal" class="form-label">Adjuntar foto de la orden: (Opcional) </label>
                                <input type="file" class="form-control" id="imagenOrdenModal">
                            </div>
                            <input type="hidden" id="id_usuario_orden_modal" name="id_usuario_orden_modal" value="<?php echo $id; ?>">
                            <button type="button" class="btn btn-primary" id="crearOrdenButtonModal" name="crearOrdenButtonModal">Crear</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4" style="margin-top: 10px;">
                <!-- Columna 3 -->
                <div class="card">
                    <div class="card-header">
                        Notas:
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="fecha-actual">Fecha Actual:</label>
                            <input type="date" class="form-control" id="fecha-actual" disabled>
                        </div>
                        <div class="form-group">
                            <label for="notas">Notas:</label>
                            <textarea class="form-control" id="notas" rows="5"></textarea>
                        </div>
                        <button class="btn btn-primary" id="guardar-notas" style="margin-top: 10px;">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .list-group-item:hover {
                background-color: #f0f0ff;
                cursor: pointer;
            }
        </style>

        <?php
        require_once 'app/obtener_notas.inc.php';

        // Obtener las notas de la base de datos para el ID de usuario especificado
        $notas = obtenerNotasDesdeBD($id);

        // Obtener el número de página actual para la primera paginación
        $paginaActual1 = isset($_GET['page1']) ? $_GET['page1'] : 1;

        // Datos de ejemplo
        $totalNotas = count($notas); // Total de notas en la base de datos
        $notasPorPagina = 10; // Número de notas a mostrar por página

        // Calcular el índice de inicio y fin de las notas a mostrar en la página actual para la primera paginación
        $indiceInicio1 = ($paginaActual1 - 1) * $notasPorPagina;
        $indiceFin1 = $indiceInicio1 + $notasPorPagina - 1;
        if ($indiceFin1 >= $totalNotas) {
            $indiceFin1 = $totalNotas - 1;
        }

        // Verificar si hay notas disponibles para la primera paginación
        if ($totalNotas > 0) {
            // Obtener las notas de la página actual para la primera paginación
            $notasPagina1 = array_slice($notas, $indiceInicio1, $notasPorPagina);
        } else {
            // No hay notas disponibles
            $notasPagina1 = [];
        }

        // Calcular el número total de páginas para la primera paginación
        $totalPaginas1 = ceil($totalNotas / $notasPorPagina);

        // Obtener el número de página actual para la segunda paginación
        $paginaActual2 = isset($_GET['page2']) ? $_GET['page2'] : 1;

        // Calcular el índice de inicio y fin de las notas a mostrar en la página actual para la segunda paginación
        $indiceInicio2 = ($paginaActual2 - 1) * $notasPorPagina;
        $indiceFin2 = $indiceInicio2 + $notasPorPagina - 1;
        if ($indiceFin2 >= $totalNotas) {
            $indiceFin2 = $totalNotas - 1;
        }

        // Verificar si hay notas disponibles para la segunda paginación
        if ($totalNotas > 0) {
            // Obtener las notas de la página actual para la segunda paginación
            $notasPagina2 = array_slice($notas, $indiceInicio2, $notasPorPagina);
        } else {
            // No hay notas disponibles
            $notasPagina2 = [];
        }

        // Calcular el número total de páginas para la segunda paginación
        $totalPaginas2 = ceil($totalNotas / $notasPorPagina);
        ?>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Notas</h2>
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-group">
                                <?php foreach ($notasPagina1 as $nota) : ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><?php echo $nota['nota']; ?></span>
                                        <span class="badge bg-primary"><?php echo $nota['fecha']; ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <nav aria-label="Paginación">
                        <ul class="pagination justify-content-center mt-3">
                            <?php if ($paginaActual1 > 1) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page1=<?php echo $paginaActual1 - 1; ?>#notas" tabindex="-1" aria-disabled="true">Anterior</a>
                                </li>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $totalPaginas1; $i++) : ?>
                                <li class="page-item<?php echo ($i == $paginaActual1) ? ' active' : ''; ?>">
                                    <a class="page-link" href="?page1=<?php echo $i; ?>#notas"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>
                            <?php if ($paginaActual1 < $totalPaginas1) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page1=<?php echo $paginaActual1 + 1; ?>#notas">Siguiente</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="informacion_paciente.js"></script>

<?php
// Limpiar las variables de sesión después de mostrar los datos
include_once 'plantillas/cierrehtml.inc.php';
?>