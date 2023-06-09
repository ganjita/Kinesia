<?php
include_once ('conexion.php');

// Crear conexión PDO
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Obtener los valores del turno actual y del turno seleccionado
$idTurnoPadre = isset($_POST['idTurnoPadre']) ? $_POST['idTurnoPadre'] : '';
$idTurnoSeleccionado = isset($_POST['idTurnoSeleccionado']) ? $_POST['idTurnoSeleccionado'] : '';


if (!empty($idTurnoPadre) && !empty($idTurnoSeleccionado)) {
    // Consulta SQL para obtener los datos del turno actual
    $sqlTurnoActual = "SELECT id_usuario, id_medico, medico, motivo, valor, pagado FROM turnos WHERE id_turno = :idTurnoPadre";

    // Consulta SQL para obtener los datos del turno seleccionado
    $sqlTurnoSeleccionado = "SELECT id_usuario, id_medico, medico, valor, pagado FROM turnos WHERE id_turno = :idTurnoSeleccionado";

    // Realizar la consulta para obtener los datos del turno actual
    $stmtTurnoActual = $conn->prepare($sqlTurnoActual);
    $stmtTurnoActual->bindParam(':idTurnoPadre', $idTurnoPadre);
    $stmtTurnoActual->execute();
    $turnoActual = $stmtTurnoActual->fetch(PDO::FETCH_ASSOC);

    // Realizar la consulta para obtener los datos del turno seleccionado
    $stmtTurnoSeleccionado = $conn->prepare($sqlTurnoSeleccionado);
    $stmtTurnoSeleccionado->bindParam(':idTurnoSeleccionado', $idTurnoSeleccionado);
    $stmtTurnoSeleccionado->execute();
    $turnoSeleccionado = $stmtTurnoSeleccionado->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontraron los dos turnos
    if ($turnoActual && $turnoSeleccionado) {
        // Realizar la actualización de los valores en la base de datos
        $sqlUpdateTurnos = "UPDATE turnos SET id_usuario = :idUsuario, id_medico = :id_medico, medico = :medico, motivo = :motivo, valor = :valor, pagado = :pagado WHERE id_turno = :idTurno";

        // Iniciar una transacción para garantizar la integridad de los datos
        $conn->beginTransaction();

        try {
            // Actualizar los datos del turno actual con los datos del turno seleccionado
            $stmtUpdateTurnoActual = $conn->prepare($sqlUpdateTurnos);
            $stmtUpdateTurnoActual->bindParam(':idUsuario', $turnoSeleccionado['id_usuario']);
            $stmtUpdateTurnoActual->bindParam(':id_medico', $turnoSeleccionado['id_medico']);
            $stmtUpdateTurnoActual->bindParam(':medico', $turnoSeleccionado['medico']);
            $stmtUpdateTurnoActual->bindParam(':motivo', $turnoSeleccionado['motivo']);
            $stmtUpdateTurnoActual->bindParam(':valor', $turnoSeleccionado['valor']);
            $stmtUpdateTurnoActual->bindParam(':pagado', $turnoSeleccionado['pagado']);
            $stmtUpdateTurnoActual->bindParam(':idTurno', $idTurnoPadre);
            $stmtUpdateTurnoActual->execute();

            // Actualizar los datos del turno seleccionado con los datos del turno actual
            $stmtUpdateTurnoSeleccionado = $conn->prepare($sqlUpdateTurnos);
            $stmtUpdateTurnoSeleccionado->bindParam(':idUsuario', $turnoActual['id_usuario']);
            $stmtUpdateTurnoSeleccionado->bindParam(':id_medico', $turnoActual['id_medico']);
            $stmtUpdateTurnoSeleccionado->bindParam(':medico', $turnoActual['medico']);
            $stmtUpdateTurnoSeleccionado->bindParam(':motivo', $turnoActual['motivo']);
            $stmtUpdateTurnoSeleccionado->bindParam(':valor', $turnoActual['valor']);
            $stmtUpdateTurnoSeleccionado->bindParam(':pagado', $turnoActual['pagado']);
            $stmtUpdateTurnoSeleccionado->bindParam(':idTurno', $idTurnoSeleccionado);
            $stmtUpdateTurnoSeleccionado->execute();

            // Confirmar la transacción
            $conn->commit();

            // Éxito en la actualización de los turnos
            echo "Los turnos se intercambiaron correctamente.";
        } catch (PDOException $e) {
            // Ocurrió un error, revertir la transacción
            $conn->rollback();
            echo "Error al intercambiar los turnos: " . $e->getMessage();
        }
    } else {
        // No se encontraron los turnos o alguno de ellos, mostrar un mensaje de error
        echo "Los turnos no existen o no se encontraron.";
    }
} else {
    // No se proporcionaron los valores de los turnos, mostrar un mensaje de error
    echo "No se proporcionaron los valores de los turnos.";
}
?>
