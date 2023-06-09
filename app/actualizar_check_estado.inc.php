<?php
include_once('conexion.php');


if (isset($_POST['checkboxstatus'])) {
    $estatus = $_POST['checkboxstatus'];
    $idTurno = $_POST['idTurno'];

    try {
        // Crear conexión PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar la consulta para obtener los turnos de la fecha
        $sql = "UPDATE turnos SET pagado = :estatus WHERE id_turno = :idTurno;";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':estatus', $estatus);
        $stmt->bindParam(':idTurno', $idTurno);
        $stmt->execute();

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // La consulta se ejecutó correctamente
            echo "Estado del pago actualizado correctamente";
        } else {
            // Error al ejecutar la consulta
            echo "Error al actualizar el estado del pago";
        }
    } catch (PDOException $e) {
        // Manejo de errores de PDO
        echo "Error de conexión: " . $e->getMessage();
    }
}
?>
