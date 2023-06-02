<?php
include_once 'conexion.php';

/////////////////////////////////////////////////////////
////GUARDA UN PACIENTE NUEVO EN LA TABLA DE USUARIOS////
///////////////////////////////////////////////////////

try {
    // Crear conexión PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

    // Consulta SQL para insertar los datos en la tabla correspondiente de tu base de datos
    $consulta = "INSERT INTO usuarios (nombre, apellido, dni, direccion, localidad, telefono, fecha_nacimiento, obra_social, nroafiliado, plan, mail, fecha_alta)
                 VALUES (:nombre, :apellido, :dni, :direccion, :localidad, :telefono, :fechanacimiento, :osocial, :nroafiliado, :plan, :mail, :fechaalta)";

    // Preparar la consulta
    $stmt = $conn->prepare($consulta);

    // Asignar los valores a los parámetros de la consulta
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':dni', $dni);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':localidad', $localidad);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':fechanacimiento', $fechanacimiento);
    $stmt->bindParam(':osocial', $osocial);
    $stmt->bindParam(':nroafiliado', $nroafiliado);
    $stmt->bindParam(':plan', $plan);
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':fechaalta', $fechaalta);

    // Ejecutar la consulta
    $stmt->execute();

    echo "Registro de paciente exitoso";
    // Redireccionar al index
    header("Location: ../index.php");
    exit();
} catch (PDOException $e) {
    echo "Error al registrar el paciente: " . $e->getMessage();
}

?>
