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
            <!-- Campo input con el selector de fecha -->
            <!-- Campo input con el selector de fecha y hora y las clases de bootstrap -->
            <input type="date" id="fecha" name="fecha" />

            <!-- Botones para el día siguiente y el día anterior con las clases de bootstrap -->
            <button type="button" id="anterior" name="anterior" class="btn btn-primary" onclick="cambiarDia(-1)">
                Día anterior
            </button>
            <button type="button" id="siguiente" name="siguiente" class="btn btn-primary" onclick="cambiarDia(1)">
                Día siguiente
            </button>
            <form action="app/obtenerturnosmedico1.php" method="POST" id="formMedico">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="medico" data-bs-toggle="dropdown" aria-expanded="false">Seleccionar Médico</button>
                    <ul class="dropdown-menu" aria-labelledby="medico">
                        <?php foreach ($medicos as $medico) { ?>
                        <li>
                            <a class="dropdown-item medicoTurnoNuevo" href="#" id="medicoselect"
                                data-value="<?php echo $medico['id']; ?>"><?php echo $medico['nombre'] . ' ' . $medico['apellido']; ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <input type="hidden" class="medicoSeleccionado" id="medicoSeleccionado" name="medicoSeleccionado">
            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
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
                    <tbody>
                        <!-- Aquí puedes usar un bucle para generar las filas por cada turno -->
                        <?php
                        
                    if (isset($_SESSION['resultados']) && !empty($_SESSION['resultados'])) {
                        $resultados[] = $_SESSION['resultados'];

                                 
                        foreach ($resultados[0] as $resultado) {

                        // Acceder a la información del turno
                        // ... acceder a los demás campos del turno según sea necesario
                          
                          echo "<tr>";
                            echo "<td>" . $resultado['medico'] . "</td>";
                            echo "<td>" . $resultado['fecha_turno'] . "</td>";
                            echo "<td>" . $resultado['hora_turno'] . "</td>";
                            echo "<td>" . $resultado['nombre'] . " " . $resultado['apellido'] . "</td>";
                            echo "<td>" . $resultado['telefono'] . "</td>";
                            echo "<td>" . $resultado['obra_social'] . "</td>";
                            echo "<td>" . $resultado['plan'] . "</td>";
                            echo "<td>" . $resultado['nroafiliado'] . "</td>";
                          echo "</tr>";

                          // Limpiar la variable de sesión después de mostrar los resultados
                         unset($_SESSION['resultados']);
                        }
                        } else { ?>
                        <tr>
                           <td>No se encontraron resultados para este Medico.</td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                       </tr>
                       <?php

                        }
                    
        ?>
                        <!--HASTA ACA EL BUCLE-->
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>
<?php
  include_once 'plantillas\cierrehtml.inc.php';
?>