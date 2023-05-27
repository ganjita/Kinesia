<?php
  include_once 'plantillas\navmenu.inc.php';
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
   <button
   type="button"
   id="anterior"
   name="anterior"
   class="btn btn-primary"
   onclick="cambiarDia(-1)"
   >
   Día anterior
   </button>
   <button
   type="button"
   id="siguiente"
   name="siguiente"
   class="btn btn-primary"
   onclick="cambiarDia(1)"
   >
   Día siguiente
   </button>

   <div class="dropdown">
    <button
    class="btn btn-secondary dropdown-toggle"
    type="button"
    id="dropdownMenuButton1"
    data-bs-toggle="dropdown"
    aria-expanded="false"
    >
    Seleccionar Medico
    </button>
    <ul
    class="dropdown-menu"
    aria-labelledby="dropdownMenuButton1"
    id="dropdownMenuButton1"
    >
    <li>
     <a class="dropdown-item turnoMedico" href="#">Emiliano Pecar</a>
    </li>
    <li>
     <a class="dropdown-item turnoMedico" href="#">Federico Miranda</a>
    </li>
    <li>
     <a class="dropdown-item  turnoMedico" href="#">Armando Esteban</a>
    </li>
    </ul>
   </div>
  </div>
 </div>
</div>

    <div class="container">
      <div class="row">
        <div class="col-6">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">Médico</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Hora</th>
                  <th scope="col">Paciente</th>
                </tr>
              </thead>
              <tbody>
                <!-- Aquí puedes usar un bucle para generar las filas por cada turno -->
                <tr>
                  
                </tr>
                <tr>
                  <td>Dr. Juan Pérez</td>
                  <td>22/05/2023</td>
                  <td>11:00</td>
                  <td>Luis Rodríguez</td>
                </tr>
                <tr>
                  <td>Dr. Ana López</td>
                  <td>22/05/2023</td>
                  <td>10:30</td>
                  <td>Pedro Sánchez</td>
                </tr>
                <!--HASTA ACA EL BUCLE-->
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-6">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">Médico</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Hora</th>
                  <th scope="col">Paciente</th>
                </tr>
              </thead>

              <tbody>
                <!-- Aquí puedes usar un bucle para generar las filas por cada turno -->
                <tr>
                  <td>Dr. Juan Pérez</td>
                  <td>22/05/2023</td>
                  <td>10:00</td>
                  <td>Maria García</td>
                </tr>
                <tr>
                  <td>Dr. Juan Pérez</td>
                  <td>22/05/2023</td>
                  <td>11:00</td>
                  <td>Luis Rodríguez</td>
                </tr>
                <tr>
                  <td>Dr. Ana López</td>
                  <td>22/05/2023</td>
                  <td>10:30</td>
                  <td>Pedro Sánchez</td>
                </tr>
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
