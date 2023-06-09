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
                                    echo $edad . " " . "Años";
                                    ?></td>
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
                                            echo "<tr>";
                                            echo "<td>" . $id_turno . "</td>";
                                            echo "<td>" . $fechaTurno . "</td>";
                                            echo "<td>" . $horaTurno . "</td>";
                                            echo "<td>" . $medico . "</td>";
                                            echo "<td>" . $motivo . "</td>";
                                            echo "<td>" . $valor . "</td>";
                                            echo "<td>" . convertirValorPagado($pagado) . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr>";
                                        echo "<td>No se encontraron Turnos</td>";
                                        echo "</tr>";
                                    }
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
                            <table>
                    </div>
                    <div id="pagination"></div> <!-- Contenedor para los botones de paginación -->
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Imágenes
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-md-4">
                            <img class="img-fluid" src="img/1.jpg" alt="">
                        </div>
                        <div class="col-6 col-md-4">
                            <img class="img-fluid" src="img/2.jpg" alt="">
                        </div>
                        <div class="col-6 col-md-4">
                            <img class="img-fluid" src="img/3.jpg" alt="">
                        </div>
                        <div class="col-6 col-md-4">
                            <img class="img-fluid" src="img/4.jpg" alt="">
                        </div>
                        <div class="col-6 col-md-4">
                            <img class="img-fluid" src="img/5.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
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
                    <button class="btn btn-primary">Realizar Entrega</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
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
                    <button class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
// Limpiar las variables de sesión después de mostrar los datos


include_once 'plantillas/footer.inc.php';
include_once 'plantillas/cierrehtml.inc.php';
?>