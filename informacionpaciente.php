<?php
include_once 'plantillas/navmenu.inc.php';

session_start();

if (isset($_SESSION['resultados']) && !empty($_SESSION['resultados'])) {
    $resultados = $_SESSION['resultados'];

    foreach ($resultados as $resultado) {
        $nombre = $resultado['nombre'];
        $apellido = $resultado['apellido'];
        $direccion = $resultado['direccion'];
        $dni = $resultado['dni'];
        $mail = $resultado['mail'];
        $localidad = $resultado['localidad'];
        $telefono = $resultado['telefono'];
        $fecha_nacimiento = $resultado['fecha_nacimiento'];
        $obra_social = $resultado['obra_social'];
        $nroafiliado = $resultado['nroafiliado'];
        $plan = $resultado['plan'];
        $fecha_alta = $resultado['fecha_alta'];
    }
}
?>

<section class="patient-info">
    <div class="row">
        <div class="col-6">
            <h2 class="patient-name"><?php echo $nombre . ' ' . $apellido; ?></h2>
            <!-- Usar el componente list-group de bootstrap 5 -->
            <ul class="list-group">
                <li class="list-group-item"><label>Dirección:</label>
                    <span class="patient-address"><?php echo $direccion; ?></span>
                </li>
                <li class="list-group-item"><label>DNI:</label>
                    <span class="patient-dni"><?php echo $dni; ?></span>
                </li>
                <li class="list-group-item"><label>Email:</label>
                    <span class="patient-email"><?php echo $mail; ?></span>
                </li>
                <li class="list-group-item"><label>Obra Social:</label>
                    <span class="patient-insurance"><?php echo $obra_social; ?></span>
                </li>
                <li class="list-group-item"><label>Fecha de Nacimiento:</label>
                    <span class="patient-birthdate"><?php echo $fecha_nacimiento; ?></span>
                </li>
            </ul>
        </div>
        <div class="col-6">
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text"><strong>Localidad:</strong> <?php echo $localidad; ?></p>
                    <p class="card-text"><strong>Teléfono:</strong> <?php echo $telefono; ?></p>
                    <p class="card-text"><strong>Número de afiliado:</strong> <?php echo $nroafiliado; ?></p>
                    <p class="card-text"><strong>Plan:</strong> <?php echo $plan; ?></p>
                    <p class="card-text"><strong>Fecha de alta:</strong> <?php echo $fecha_alta; ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Limpiar las variables de sesión después de mostrar los datos
unset($_SESSION['resultados']);

include_once 'plantillas/cierrehtml.inc.php';
?>