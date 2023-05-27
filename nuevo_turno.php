<?php 
  include 'plantillas/navmenu.inc.php';

session_start();

       
?>


<!-- Usar el componente form de bootstrap 5 -->
<div class="container">
    <div class="row">
        <div class="container col-6">
<form action="app\buscarpacienteregturno.php" method="POST" class="appointment-form container-fluid"> <!--PROCESAR FORMULARIO-->
<h2 class="form-title">Solicitud de Turno</h2>

<div class="mb-3">
  <label for="busqueda" class="form-label">Buscar Paciente:</label>
  <div class="input-group">
    <input type="text" id="busqueda" name="busqueda" placeholder="Nombre Apellido o DNI" class="form-control">
    <button type="submit1" class="btn btn-secondary btn-search" name="submit1">Buscar</button>
  </div>
</div>


<div class="mb-3">
<label for="nombre" class="form-label">Nombre Completo:</label>
<input type="text" id="nombre" name="nombre"  class="form-control">
</div>

<div class="mb-3">
<label for="direccion" class="form-label">Direccion:</label>
<input type="text" id="direccion" name="direccion"  class="form-control">
</div>

<div class="mb-3">
<label for="email" class="form-label">Email:</label>
<input type="email" id="email" name="email"  class="form-control">
</div>

<div class="mb-3">
<label for="telefono" class="form-label">Teléfono:</label>
<input type="tel" id="telefono" name="telefono"  class="form-control">
</div>

<div class="mb-3">
<label for="fecha" class="form-label">Fecha del Turno:</label>
<input type="date" id="fecha" name="fecha"  class="form-control">
</div>


<!-- Crear un elemento div para el campo de formulario -->
<div class="mb-3">
  <!-- Crear una etiqueta para el campo -->
  <label for="medico" class="form-label">Seleccionar Médico:</label>
  <!-- Crear un elemento div para el componente Dropdown -->
  <div class="dropdown">
    <!-- Crear un botón que activa la lista desplegable -->
    <button class="btn btn-secondary dropdown-toggle" type="button" id="medico" data-bs-toggle="dropdown" aria-expanded="false">Seleccionar Médico</button>
    <!-- Crear una lista desordenada con las opciones de la lista desplegable -->
    <ul class="dropdown-menu" aria-labelledby="medico">
      <!-- Crear un elemento de lista con un enlace para cada opción ACA VAMOS A TRAER LOS MEDICOS DESDE LA BASE DE DATOS-->
      <li>
        <a class="dropdown-item medicoTurnoNuevo" href="#" value="1">Dr. Juan Pérez</a>
      </li>
      <li>
        <a class="dropdown-item medicoTurnoNuevo" href="#" value="2">Dra. Ana López</a>
      </li>
      <li>
        <a class="dropdown-item medicoTurnoNuevo" href="#" value="3">Dr. Luis Rodríguez</a>
      </li>
    </ul>
  </div>
</div>


<div class="mb-3">
<label for="hora" class="form-label">Hora del Turno:</label>
<input type="time" id="hora" name="hora"  class="form-control">
</div>

<div class="mb-3">
<label for="motivo" class="form-label">Motivo de la Consulta:</label>
<textarea id="motivo" name="motivo" rows="4"  class="form-control"></textarea>
</div>

<div class="mb-3">
    <label for="valor-consulta" class="form-label">Valor $:</label>
    <input type="number" id="valor-consulta" name="valor-consulta"  class="form-control">
    </div>

<button type="submit2" class="btn btn-primary btn-submit">Solicitar Turno</button>


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
                <th>Email</th>
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
                  echo "<td>" . $resultado["id"] . "</td>";
                  echo "<td>" . $resultado['nombre'] . "</td>";
                  echo "<td>" . $resultado['apellido'] . "</td>";
                  echo "<td>" . $resultado['dni'] . "</td>";
                  echo "<td>" . $resultado['direccion'] . "</td>";
                  echo "<td>" . $resultado['mail'] . "</td>";
              echo "</tr>";
}

           ?>
        </tbody>
    </table>
    <?php
    // Limpiar la variable de sesión después de mostrar los resultados
    unset($_SESSION['resultados']);
}
 else { ?>
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
</div>

<?php

    include 'plantillas/cierrehtml.inc.php';
?>