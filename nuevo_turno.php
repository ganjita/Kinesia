<?php
include 'plantillas/navmenu.inc.php';
include_once 'app/recuperarmedico.inc.php';

session_start();
?>

<!-- Usar el componente form de bootstrap 5 -->
<div class="container" style="margin-top: 30px;">
  <div class="row">
  <div class="container col-6" style="margin-bottom: 50px;">
      <form action="app\buscarpacienteregturno.php" method="POST" class="appointment-form container-fluid"> <!--PROCESAR FORMULARIO-->
        <h2 class="form-title">Solicitud de Turno</h2>

        <div class="mb-3">
          <label for="busqueda" class="form-label">Buscar Paciente:</label>
          <div class="input-group">
            <input type="text" id="busqueda" name="busqueda" placeholder="Nombre Apellido o DNI" class="form-control">
            <button type="submit1" class="btn btn-secondary btn-search" name="submit1">Buscar</button>
          </div>
        </div>

        <div class="mb-3" hidden>
          <label for="id-paciente" class="form-label"></label>
          <input type="int" id="id-paciente" name="id-paciente" class="form-control">
        </div>

        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre Completo:</label>
          <input type="text" id="nombre" name="nombre" class="form-control">
        </div>

        <div class="mb-3">
          <label for="direccion" class="form-label">Direccion:</label>
          <input type="text" id="direccion" name="direccion" class="form-control">
        </div>

        <div class="mb-3">
          <label for="osocial" class="form-label">Obra Social:</label>
          <input type="osocial" id="osocial" name="osocial" class="form-control">
        </div>

        <div class="mb-3">
          <label for="plan" class="form-label">Plan:</label>
          <input type="plan" id="plan" name="plan" class="form-control">
        </div>

        <div class="mb-3">
          <label for="nroafiliado" class="form-label">Nro Afiliado:</label>
          <input type="nroafiliado" id="nroafiliado" name="nroafiliado" class="form-control">
        </div>

        <div class="mb-3">
          <label for="telefono" class="form-label">Teléfono:</label>
          <input type="tel" id="telefono" name="telefono" class="form-control">
        </div>

        <div class="mb-3">
          <label for="ordenContainer" class="form-label">Orden a la que corresponde el turno solicitado?:</label>
          <div id="ordenContainer" name="ordenContainer">
          </div>
        </div>

        <div class="mb-3">
          <label for="fecha" class="form-label">Fecha del Turno:</label>
          <input type="date" id="fecha" name="fecha" class="form-control">
        </div>

        <div class="mb-3">
          <label for="hora" class="form-label">Hora del Turno:</label>
          <input type="time" id="hora" name="hora" class="form-control">
        </div>
        <br>
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="medico" data-bs-toggle="dropdown" aria-expanded="false">Seleccionar Médico</button>
          <ul class="dropdown-menu" aria-labelledby="medico">
            <?php foreach ($medicos as $medico) { ?>
              <li>
                <button class="dropdown-item medicoTurnoNuevo" type="button" data-value="<?php echo $medico['id']; ?>"><?php echo $medico['nombre'] . ' ' . $medico['apellido']; ?></button>
              </li>
            <?php } ?>
          </ul>
          <input type="hidden" class="medicoSeleccionado" id="medicoSeleccionado" name="medicoSeleccionado">
          <input type="hidden" class="idMedicoSeleccionado" id="idMedicoSeleccionado" name="idMedicoSeleccionado">

        </div>


        <br>
        <div class="mb-3">
          <label for="motivo" class="form-label">Motivo de la Consulta:</label>
          <textarea type="text" id="motivo" name="motivo" rows="4" class="form-control"></textarea>
        </div>

        <div class="mb-3">
          <label for="valor-consulta" class="form-label">Valor $:</label>
          <input type="number" id="valor-consulta" name="valor-consulta" class="form-control">
          <div class="form-check form-check-inline d-flex align-items-left justify-content-left" style="margin-top: 5px;">
            <input class="form-check-input" type="checkbox" id="checkpagoturno" name="checkpagoturno">
            <label class="form-check-label" for="checkpagoturno" style="margin-left: 6px;">ESTA PÁGO (tilda para marcar que esta pagado)</label>
          </div>

        </div>
        <div class="input-group">
          <button type="submit2" id="regturno" name="regturno" class="btn btn-primary btn-submit">Solicitar Turno</button>
        </div>
        <div class="alert alert-danger mt-3" role="alert" id="error-message" style="display: none;">
          <strong>Error:</strong> Debes completar todos los campos.
        </div>
      </form>
    </div>


    <!-- Usar el componente table de bootstrap 5 -->
    <div class="container col-6">
      <h2>Resultados de la búsqueda</h2>

      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>DNI</th>
            <th>Dirección</th>
            <th>Obra Social</th>
          </tr>
        </thead>
        <tbody>

          <?php
          // Verificar si los arrays de resultados están definidos

          if (isset($_SESSION['resultados']) && !empty($_SESSION['resultados'])) {
            $resultados[] = $_SESSION['resultados'];


            foreach ($resultados[0] as $resultado) {
              $pacienteId = $resultado['id'];


              echo '<tr data-id="' . $pacienteId . '">';
              echo "<td class='id_usuario' hidden>" . $pacienteId . "</td>";
              echo "<td>" . $resultado["id"] . "</td>";
              echo "<td class='nombre'>" . $resultado['nombre'] . "</td>";
              echo "<td class='apellido'>" . $resultado['apellido'] . "</td>";
              echo "<td>" . $resultado['dni'] . "</td>";
              echo "<td class='direccion'>" . $resultado['direccion'] . "</td>";
              echo "<td class='osocial'>" . $resultado['obra_social'] . "</td>";
              echo "<td class='plan' hidden>" . $resultado['plan'] . "</td>";
              echo "<td class='nroafiliado' hidden>" . $resultado['nroafiliado'] . "</td>";
              echo "<td class='telefono' hidden>" . $resultado['telefono'] . "</td>";

              echo "</tr>";
            }

          ?>
        </tbody>
      </table>
    <?php
            // Limpiar la variable de sesión después de mostrar los resultados
            unset($_SESSION['resultados']);
          } else { ?>
      <tr>
        <td>No se encontraron resultados.</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    <?php
          }
    ?>
    </div>
  </div>
</div>

<script>
  
  $(document).ready(function() {
  $('#regturno').click(function(event) {
    var camposCompletos = true; // Suponemos que todos los campos están completos

    // Validar que todos los campos, excepto el campo con ID "busqueda", no estén vacíos
    $('form input:not(#busqueda), form select, form textarea').each(function() {
      if ($(this).val() === '') {
        camposCompletos = false;
        return false; // Detener la iteración si se encuentra un campo vacío
      }
    });

    // Mostrar u ocultar el mensaje de error según el estado de los campos
    if (!camposCompletos) {
      $('#error-message').show();
      event.preventDefault(); // Evitar que el formulario se envíe si faltan campos, excepto "busqueda"
    } else {
      $('#error-message').hide();
    }
  });
});

</script>


</script>

<?php
include 'plantillas/cierrehtml.inc.php';


?>