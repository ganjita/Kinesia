<?php
include_once 'plantillas\navmenu.inc.php';
session_start();
?>

<!-- Usar el componente form de bootstrap 5 -->
<div class="row justify-content-center" style="margin-top: 30px;">
  <div class="col-6">
    <form action="app/buscar_pacienteapp.php" method="POST" class="search-form formulario">
      <h2 class="form-title text-center">Búsqueda de Paciente</h2>

      <div class="mb-3 text-center">
        <label for="nombre_apellido" class="form-label">Nombre o Apellido:</label>
        <input type="text" id="nombre_apellido" name="nombre_apellido" class="form-control">
      </div>

      <div class="mb-3 text-center">
        <label for="dni" class="form-label">DNI:</label>
        <input type="int" id="dni" name="dni" class="form-control">
      </div>

      <div class="mb-3 text-center">
        <label for="direccion" class="form-label">Dirección:</label>
        <input type="text" id="direccion" name="direccion" class="form-control">
      </div>

      <div class="mb-3 text-center">
        <label for="telefono" class="form-label">Telefono:</label>
        <input type="text" id="telefono" name="telefono" class="form-control">
      </div>


      <div class="col-12 d-flex justify-content-center">
        <button type="submit" class="btn btn-primary btn-submit align-items-center">Buscar Paciente</button>
      </div>
    </form>
  </div>
  <div class="col-6">
  <table class="table" name="tablaBuscarUsuarios" id="tablaBuscarUsuarios">
        <thead>
          <tr id="fila-usuariosBloqueada">
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">DNI</th>
            <th scope="col">Dirección</th>            
            <th scope="col">Tel:</th>            
            <th scope="col">Obra Social</th>
          </tr>
        </thead>
        <tbody id="resultadosUsuarios">

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
              echo "<td class='telefono'>" . $resultado['telefono'] . "</td>";
              echo "<td class='osocial'>" . $resultado['obra_social'] . "</td>";
              echo "<td class='plan' hidden>" . $resultado['plan'] . "</td>";
              echo "<td class='nroafiliado' hidden>" . $resultado['nroafiliado'] . "</td>";
              echo "</tr>";
            }
          }
          ?>
        </tbody>
      </table>
      


  </div>
  
</div>

<?php
session_unset();
include_once 'plantillas/cierrehtml.inc.php';
?>