<?php
include_once('conexion.php');

// Obtener el valor de la nueva hora
$nuevaHora = $_POST['nuevaHora'];
$nuevaFecha = $_POST['nuevaFecha'];

// Obtener el ID del turno
$idTurno = $_POST['idTurno'];

try {
    // Crear conexión PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($nuevaHora)) {

    // Preparar la consulta SQL
    $sql = "UPDATE turnos SET hora_turno = :nuevaHora WHERE id_turno = :idTurno";
    $stmt = $conn->prepare($sql);

    // Asignar los valores a los parámetros de la consulta
    $stmt->bindParam(':nuevaHora', $nuevaHora);
    $stmt->bindParam(':idTurno', $idTurno);

    // Ejecutar la consulta
    $stmt->execute();

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // La consulta se ejecutó correctamente
        echo "Hora actualizada con éxito";
    } else {
        // Error al ejecutar la consulta
        echo "Error al actualizar la hora";
    }
    }elseif ($nuevaFecha != '') {
        // Preparar la consulta SQL
    $sql = "UPDATE turnos SET fecha_turno = :nuevaFecha WHERE id_turno = :idTurno";
    $stmt = $conn->prepare($sql);

    // Asignar los valores a los parámetros de la consulta
    $stmt->bindParam(':nuevaFecha', $nuevaFecha);
    $stmt->bindParam(':idTurno', $idTurno);

    // Ejecutar la consulta
    $stmt->execute();

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // La consulta se ejecutó correctamente
        echo "Fecha actualizada con éxito";
    } else {
        // Error al ejecutar la consulta
        echo "Error al actualizar la Fecha";
    }
} 
}catch (PDOException $e) {
    // Manejo de errores de PDO
    echo "Error de conexión: " . $e->getMessage();
}
