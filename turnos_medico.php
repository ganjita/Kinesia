<?php
include_once 'plantillas/navmenu.inc.php';
include_once 'app/recuperarmedico.inc.php';

session_start();
?>

<div class="container" style="margin-top: 30px;">
    <div class="row">
        <div class="col-12 col-md-6">
            <h1>Listado de turnos diarios</h1>
        </div>
        <div class="col-12 col-md-6 d-flex justify-content-between align-items-center flex-wrap">
            <!-- Campo input con el selector de fecha y hora y las clases de bootstrap -->
            <input type="date" id="fecha" name="fecha" />

            <!-- Botones para el día siguiente y el día anterior con las clases de bootstrap -->
            <button type="button" id="anterior" name="anterior" class="btn btn-primary selectorFecha" onclick="cambiarDia(1)">
                Día anterior
            </button>
            <button type="button" id="siguiente" name="siguiente" class="btn btn-primary selectorFecha" onclick="cambiarDia(1)">
                Día siguiente
            </button>

            <!-- Formulario de selección de médico -->
            <form id="formMedico">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="medico" data-bs-toggle="dropdown" aria-expanded="false">Seleccionar Médico</button>
                    <ul class="dropdown-menu" aria-labelledby="medico">
                        <li>
                            <button class="dropdown-item medicoTurnoNuevo" id="tlm" href="#" data-value="tlm">Todos los Turnos</button>
                        </li>
                        <?php foreach ($medicos as $medico) { ?>
                            <li>
                                <button class="dropdown-item medicoTurnoNuevo" href="#" data-value="<?php echo $medico['id']; ?>"><?php echo $medico['nombre'] . ' ' . $medico['apellido']; ?></button>
                            </li>
                        <?php } ?>
                    </ul>
                    <input type="hidden" class="medicoSeleccionado" id="medicoSeleccionado" name="medicoSeleccionado">
                    <input type="hidden" class="idMedicoSeleccionado" id="idMedicoSeleccionado" name="idMedicoSeleccionado">
                </div>
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
                        <div class="modal-header" id="cerrarmodal">
                            <h5 class="modal-title" id="detalleTurnoModalLabel">Detalles del Turno</h5>
                            <button type="button" class="btn-close close" id="close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                            <input type="int" id="idTurnoFila" name="idTurnoFila" hidden>
                            <input type="int" id="idUsuarioFila" name="idUsuarioFila" hidden>
                        </div>
                        <div class="modal-body" id="detalleTurnoModalBody">
                            <!-- Contenido del detalle del turno -->

                        </div>
                        <div class="form-check form-check-inline d-flex align-items-center justify-content-center">
                            <input class="form-check-input" type="checkbox" id="checkbox2" style="margin-left: 3px;" ;>
                            <label class=" form-check-label" for="checkbox2" style="margin-left: 3px;">ESTA PÁGO (tilda para marcar que esta pagado)</label>
                            <button type="button" class="btn btn-success" id="actEstadoBtn">Actualizar estado</button>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="intercambiarTurnoBtn">Intercambiar Turno por otro</button>
                            <button type="button" class="btn btn-primary" id="editarFechaBtn">Editar Fecha</button>
                            <button type="button" class="btn btn-primary" id="editarHoraBtn">Editar Hora</button>
                            <button type="button" class="btn btn-danger" id="eliminarTurnoBtn">Eliminar Turno</button>
                            <button type="button" class="btn btn-danger" id="fichaDelPaciente">Ficha del Paciente</button>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Popup para editar la fecha -->
            <div class="modal fade" id="editarFechaModal" tabindex="-1" role="dialog" aria-labelledby="editarFechaModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-info">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarFechaModalLabel">Editar Fecha</h5>
                            <button type="button" class="btn-close close" aria-label="Close">
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
                            <button type="button" class="btn-close close" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="time" id="nuevaHora" class="form-control">
                            <input type="hidden" id="turnoIdHora">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="confirmarHoraBtn">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Popup para Intercambiar turno -->
            <div class="modal fade" id="cambiarTurnoModal" tabindex="-1" role="dialog" aria-labelledby="cambiarTurnoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="popupModalLabel">Intercambiar turno por otro que este en que fecha y hora? (Tiene que ser exacto):</h5>
                            <button type="button" class="btn-close close" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="popupForm">
                                <div class="mb-3">
                                    <label for="fecha" class="form-label">Fecha:</label>
                                    <input type="date" class="form-control" id="fechaIntercambioTurno" required>
                                </div>
                                <div class="mb-3">
                                    <br>
                                    <label for="cambioTurno" class="form-label">El turno actual se cambiara por el siguiente:</label>
                                    <input type="hidden" id="idTurnoSeleccionado" name="idTurnoSeleccionado">
                                    <input type="hidden" id="idTurnoPadre" name="idTurnoPadre">
                                    <input type="text" class="form-control" id="campoTurnoSeleccionado" placeholder="Turno por el que se hara el cambio" readonly>
                                </div>
                                <button type="button" class="btn btn-primary" id="consultarTurnosDisponible">Consultar</button>
                                <button type="button" class="btn btn-success" id="cambiarTurno">Cambiar Turno</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Popup para mostrar los resultados de la búsqueda -->
            <div class="modal fade" id="resultadosModal" tabindex="-1" role="dialog" aria-labelledby="resultadosModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="resultadosModalLabel">Resultados de la búsqueda</h5>
                            <button type="button" class="btn-close close" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="resultadosBusqueda">
                            <!-- Aquí se mostrarán los resultados de la búsqueda -->
                        </div>
                    </div>
                </div>
            </div>




            <!-- Ventana de confirmación -->
            <div class="modal fade" id="confirmacionModal" tabindex="-1" role="dialog" aria-labelledby="confirmacionModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmacionModalLabel">Confirmar Eliminación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de que deseas eliminar el turno?
                        </div>
                        <input type="hidden" id="turnoIdEliminar">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger" id="confirmarEliminacionBtn">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>


            <?php
            include_once 'plantillas\cierrehtml.inc.php';
            ?>