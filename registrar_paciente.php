<?php
  include_once 'plantillas/navmenu.inc.php';
?>
    <!-- Usar el componente form de bootstrap 5 -->
    <div class="row justify-content-center">
      <div class="col-8">
        <form action="app/guardar_paciente.php" method="POST" class="patient-form formulario">
            
          <!--PROCESAR FORMULARIO-->
          <h2 class="form-title text-center">Registro de Paciente</h2>

          <div class="row d-flex">
            <div class="col-6">
          <div class="mb-3 text-center">
            <label for="nombre" class="form-label">Nombre:</label>
            <input
              type="text"
              id="nombre"
              name="nombre"
              required
              class="form-control"
            />
          </div>

          <div class="mb-3 text-center">
            <label for="apellido" class="form-label">Apellido:</label>
            <input
              type="text"
              id="apellido"
              name="apellido"
              required
              class="form-control"
            />
          </div>

          <div class="mb-3 text-center">
            <label for="dni" class="form-label">DNI:</label>
            <input type="text" id="dni" name="dni" required="" class="form-control">
            </div>

          <div class="mb-3 text-center">
            <label for="direccion" class="form-label">Dirección:</label>
            <input
              type="text"
              id="direccion"
              name="direccion"
              required
              class="form-control"
            />
          </div>

          <div class="mb-3 text-center">
            <label for="localidad" class="form-label">Localidad:</label>
            <input
              type="text"
              id="localidad"
              name="localidad"
              required
              class="form-control"
            />
          </div>

          <div class="mb-3 text-center">
            <label for="telefono" class="form-label">Telefono:</label>
            <input
              type="number"
              id="telefono"
              name="telefono"
              required
              class="form-control"
            />
          </div>
        </div>
        <div class="col-6">
          <div class="mb-3 text-center">
            <label for="fechanacimiento" class="form-label"
              >Fecha de Nacimiento:</label
            >
            <input
              type="date"
              id="fechanacimiento"
              name="fechanacimiento"
              required
              class="form-control"
            />
          </div>

          <div class="mb-3 text-center">
            <label for="osocial" class="form-label">Obra Social:</label>
            <input
              type="text"
              id="osocial"
              name="osocial"
              required
              class="form-control"
            />
          </div>

          <div class="mb-3 text-center">
            <label for="nroafiliado" class="form-label"
              >Numero de Afiliado:</label
            >
            <input
              type="text"
              id="nroafiliado"
              name="nroafiliado"
              required=""
              class="form-control"
            />
          </div>

          <div class="mb-3 text-center">
            <label for="plan" class="form-label">Plan:</label>
            <input
              type="text"
              id="plan"
              name="plan"
              required=""
              class="form-control"
            />
          </div>

          <div class="mb-3 text-center">
            <label for="mail" class="form-label">Email:</label>
            <input type="email" id="mail" name="mail" class="form-control" />
          </div>

          <div class="mb-3 text-center" hidden>
            <label for="fechaalta" class="form-label">Fecha de Alta:</label>
            <input
              type="date"
              id="fecha"
              name="fecha"
              class="form-control"
              readonly
            />
          </div>
        </div>
        </div>

          <div class="col-12 d-flex justify-content-center">
            <button
              type="submit"
              class="btn btn-primary btn-submit align-items-center"
            >
              Registrar Paciente
            </button>
          </div>
        </form>
      </div>
    </div>

    <?php
  include_once 'plantillas/cierrehtml.inc.php';
?>
