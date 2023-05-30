<?php
include_once 'plantillas\navmenu.inc.php';
?>

<!-- Usar el componente form de bootstrap 5 -->
<div class="row justify-content-center">
  <div class="col-4">
    <form action="app/buscar_pacienteapp.php" method="POST" class="search-form formulario">
      <h2 class="form-title text-center">Búsqueda de Paciente</h2>

      <div class="mb-3 text-center">
        <label for="nombre_apellido" class="form-label">Nombre y Apellido:</label>
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


      <div class="col-12 d-flex justify-content-center">
        <button type="submit" class="btn btn-primary btn-submit align-items-center">Buscar Paciente</button>
      </div>


    </form>
  </div>
</div>

<?php
include_once 'plantillas\cierrehtml.inc.php';
?>