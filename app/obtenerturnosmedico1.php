<?php
include_once ('conexion.php');
session_start();

try {
    // Crear conexión PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener el ID del médico desde el formulario
    $medico = $_POST['medicoSeleccionado'];

    // Construir la consulta SQL para obtener los turnos del médico y la información del usuario
    $consulta = "SELECT t.*, u.nombre, u.apellido, u.telefono, u.obra_social, u.nroafiliado, u.plan
                 FROM turnos t
                 JOIN usuarios u ON t.id_usuario = u.id
                 WHERE t.medico = :idMedico";

    // Preparar la consulta
    $stmt = $conn->prepare($consulta);

    // Asignar el valor del ID del médico al parámetro de la consulta
    $stmt->bindParam(':idMedico', $medico);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener los resultados de la consulta
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);


    // Verificar si se encontraron resultados
    if (!empty($resultados)) {
        // Recorrer los resultados
        $_SESSION['resultados'] = $resultados;

        header('location: ../turnos_medico.php');
    } else {
        session_destroy();
        header('location: ../turnos_medico.php');

    }
} catch (PDOException $e) {
    echo "Error al ejecutar la consulta: " . $e->getMessage();
}

// Cerrar la conexión
$conn = null;

?>