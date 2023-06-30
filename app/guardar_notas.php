<?php 
include_once 'conexion.php';

// Obtener los datos enviados por la solicitud AJAX
$fecha = $_POST['fecha'];
$texto = $_POST['texto'];
$usuarioId = $_POST['usuarioId'];

try {
    // Crear conexión PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Definir la consulta SQL con marcadores de posición
    $consulta = "INSERT INTO notas (id_usuario, nota, fecha) VALUES (:usuarioId, :texto, :fecha)";

    // Preparar la consulta
    $stmt = $conn->prepare($consulta);

    // Asignar los valores a los marcadores de posición
    $stmt->bindParam(':usuarioId', $usuarioId);
    $stmt->bindParam(':texto', $texto);
    $stmt->bindParam(':fecha', $fecha);

    // Ejecutar la consulta
    $stmt->execute();

    // Cerrar la conexión PDO
    $conn = null;

    // Enviar respuesta de éxito a la solicitud AJAX
    echo "Los datos se guardaron correctamente.";
} catch (PDOException $e) {
    // Manejo de errores en caso de falla en la conexión o consulta
    echo "Error al guardar los datos en la base de datos: " . $e->getMessage();
}


?>
