

<?php

include_once 'plantillas\navmenu.inc.php';

session_start();

if (isset($_SESSION['nombre']) && isset($_SESSION['apellido']) && isset($_SESSION['dni']) && isset($_SESSION['direccion']) && isset($_SESSION['localidad']) && isset($_SESSION['telefono']) && isset($_SESSION['fecha_nacimiento']) && isset($_SESSION['obra_social']) && isset($_SESSION['nroafiliado']) && isset($_SESSION['plan']) && isset($_SESSION['mail']) && isset($_SESSION['fecha_alta'])) {
    $nombre = $_SESSION['nombre'];
    $apellido = $_SESSION['apellido'];
    $dni = $_SESSION['dni'];
    $direccion = $_SESSION['direccion'];
    $localidad = $_SESSION['localidad'];
    $telefono = $_SESSION['telefono'];
    $fecha_nacimiento = $_SESSION['fecha_nacimiento'];
    $obra_social = $_SESSION['obra_social'];
    $nroafiliado = $_SESSION['nroafiliado'];
    $plan = $_SESSION['plan'];
    $mail = $_SESSION['mail'];
    $fecha_alta = $_SESSION['fecha_alta'];
}

    ?>
    
<section class="patient-info">
    <div class="row">
        <div class="col-6">
            <h2 class="patient-name"><?php echo $nombre . ' ' . $apellido; ?></h2>
            <!-- Usar el componente list-group de bootstrap 5 -->
            <ul class="list-group">
            <li class="list-group-item"><label>Dirección:</label>
            <span class="patient-address"><?php echo $direccion; ?></span></li>
            <li class="list-group-item"><label>DNI:</label>
            <span class="patient-dni"><?php echo $dni; ?></span></li>
            <li class="list-group-item"><label>Email:</label>
            <span class="patient-email"><?php echo $mail; ?></span></li>
            <li class="list-group-item"><label>Obra Social:</label>
            <span class="patient-insurance"><?php echo $obra_social; ?></span></li>
            <li class="list-group-item"><label>Fecha de Nacimiento:</label>
            <span class="patient-birthdate"><?php echo $fecha_nacimiento; ?></span></li>
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
        </ul>
    </div>
</section>

    
<?php

// Limpiar las variables de sesión después de mostrar los datos
unset($_SESSION['nombre']);
unset($_SESSION['apellido']);
unset($_SESSION['direccion']);
unset($_SESSION['localidad']);
unset($_SESSION['telefono']);
unset($_SESSION['fecha_nacimiento']);
unset($_SESSION['obra_social']);
unset($_SESSION['nroafiliado']);
unset($_SESSION['plan']);
unset($_SESSION['mail']);
unset($_SESSION['fecha_alta']);


include_once 'plantillas\cierrehtml.inc.php';
?>