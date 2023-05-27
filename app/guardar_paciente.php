<?php
include_once 'conexion.php';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Resto del código para procesar y guardar la información del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$dni = $_POST['dni'];
$direccion = $_POST['direccion'];
$localidad = $_POST['localidad'];
$telefono = $_POST['telefono'];
$fechanacimiento = $_POST['fechanacimiento'];
$osocial = $_POST['osocial'];
$nroafiliado = $_POST['nroafiliado'];
$plan = $_POST['plan'];
$mail = $_POST['mail'];
$fechaalta = $_POST['fecha'];

//consulta SQL para insertar los datos en la tabla correspondiente de tu base de datos

$sql = "INSERT INTO usuarios (nombre, apellido, dni, direccion, localidad, telefono, fecha_nacimiento, obra_social, nroafiliado, plan, mail, fecha_alta)
        VALUES ('$nombre', '$apellido', '$dni', '$direccion', '$localidad', '$telefono', '$fechanacimiento', '$osocial', '$nroafiliado', '$plan', '$mail', '$fechaalta')";

if ($conn->query($sql) === TRUE) {
    echo "Registro de paciente exitoso";
    // Redireccionar al index
    header("Location: ../index.php");
    exit();

} else {
    echo "Error al registrar el paciente: " . $conn->error;
}

?>
