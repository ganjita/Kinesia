<?php
include_once 'plantillas/navmenu.inc.php';
include_once 'app/recuperarmedico.inc.php';

session_start();
?>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-6">
            <h1>Listado de turnos diarios</h1>
        </div>
        <div class="col-12 col-md-6 d-flex justify-content-between align-items-center flex-wrap">
            <!-- Campo input con el selector de fecha y hora y las clases de bootstrap -->
            <input type="date" id="fecha" name="fecha" />

            <!-- Botones para el día siguiente y el día anterior con las clases de bootstrap -->
            <button type="button" id="anterior" name="anterior" class="btn btn-primary" onclick="cambiarDia(-1)">
                Día anterior
            </button>
            <button type="button" id="siguiente" name="siguiente" class="btn btn-primary" onclick="cambiarDia(1)">
                Día siguiente
            </button>

            <!--ACA EMPIEZA EL FORMULARIO-->
            <form id="formMedico">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="medico" data-bs-toggle="dropdown" aria-expanded="false">Seleccionar Médico</button>
                    <ul class="dropdown-menu" aria-labelledby="medico">
                        <li>
                            <button class="dropdown-item medicoTurnoNuevo" href="#" data-value="<?php echo 'Todos'; ?>"><?php echo 'Todos' ?></button>
                        </li>
                        <?php foreach ($medicos as $medico) { ?>
                            <li>
                                <button class="dropdown-item medicoTurnoNuevo" href="#" data-value="<?php echo $medico['id']; ?>"><?php echo $medico['nombre'] . ' ' . $medico['apellido']; ?></button>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <input type="hidden" class="medicoSeleccionado" id="medicoSeleccionado" name="medicoSeleccionado">
            </form>


        </div>
    </div>
</div>

<div class="container" id="turnos-container">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr id="fila-bloqueada">
                            <th scope="col">Médico</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Paciente</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">O.Social</th>
                            <th scope="col">Plan</th>
                            <th scope="col">Nro.Afiliado</th>
                        </tr>
                    </thead>
                    <tbody id="resultadoTurnos">
                        <!-- Filas generadas dinámicamente -->
                    </tbody>
                </table>
            </div>

            <!-- Ventana popup -->
            <div class="modal fade" id="detalleTurnoModal" tabindex="-1" role="dialog" aria-labelledby="detalleTurnoModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detalleTurnoModalLabel">Detalles del Turno</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="detalleTurnoModalBody">
                            <!-- Contenido del detalle del turno -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="intercambiarTurnoBtn">Intercambiar Turno por otro</button>
                            <button type="button" class="btn btn-primary" id="editarFechaBtn">Editar Fecha</button>
                            <button type="button" class="btn btn-primary" id="editarHoraBtn">Editar Hora</button>
                            <button type="button" class="btn btn-danger">Eliminar Turno</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Popup para editar la fecha -->
            <div class="modal fade" id="editarFechaModal" tabindex="-1" role="dialog" aria-labelledby="editarFechaModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarFechaModalLabel">Editar Fecha</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="date" id="nuevaFecha" class="form-control">
                            <input type="hidden" id="turnoIdFecha">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="confirmarFechaBtn">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Popup para editar la hora -->
            <div class="modal fade" id="editarHoraModal" tabindex="-1" role="dialog" aria-labelledby="editarHoraModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarHoraModalLabel">Editar Hora</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="time" id="nuevaHora" class="form-control">
                            <input type="hidden" id="turnoIdHora">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary"  id="confirmarHoraBtn">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>
            

            <!-- Popup para Intercambiar turno -->
            <div class="modal fade" id="cambiarTurnoModal" tabindex="-1" role="dialog" aria-labelledby="cambiarTurnoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="popupModalLabel">Seleccionar Fecha y Hora</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="popupForm">
                                <div class="mb-3">
                                    <label for="fecha" class="form-label">Fecha:</label>
                                    <input type="date" class="form-control" id="fecha" required>
                                </div>
                                <div class="mb-3">
                                    <label for="hora" class="form-label">Hora:</label>
                                    <input type="time" class="form-control" id="hora" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Consultar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            include_once 'plantillas\cierrehtml.inc.php';
            ?>