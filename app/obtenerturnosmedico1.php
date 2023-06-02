<?php
include_once('conexion.php');
session_start();

$html = '';

///////////////////////////////////////////////////////////////
//////CONSULTAS SOBRE TURNOS RELACIONADOS CON LOS USUARIOS////
//////////////////////////////////////////////////////////////

if (isset($_POST['medicoSeleccionado']) && !empty($_POST)) {
    try {
        // Crear conexión PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Obtener el ID del médico desde el formulario
        $medico = $_POST['medicoSeleccionado'];

        if ($medico === 'Todos') {
            // Construir la consulta SQL para obtener todos los turnos de todos los médicos y la información del usuario
            $consulta = "SELECT t.*, u.nombre, u.apellido, u.telefono, u.obra_social, u.nroafiliado, u.plan
                         FROM turnos t
                         JOIN usuarios u ON t.id_usuario = u.id";

            // Preparar la consulta
            $stmt = $conn->prepare($consulta);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener los resultados de la consulta
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (isset($resultados) && !empty($resultados)) {
                foreach ($resultados as $resultado) {
                    // Acceder a la información del turno
                    // ... acceder a los demás campos del turno según sea necesario

                    $html .= '<tr data-idturno="' . $resultado['id_turno'] . '">';
                    $html .= "<td>" . $resultado['medico'] . "</td>";
                    $html .= "<td>" . $resultado['fecha_turno'] . "</td>";
                    $html .= "<td>" . $resultado['hora_turno'] . "</td>";
                    $html .= "<td>" . $resultado['nombre'] . " " . $resultado['apellido'] . "</td>";
                    $html .= "<td>" . $resultado['telefono'] . "</td>";
                    $html .= "<td>" . $resultado['obra_social'] . "</td>";
                    $html .= "<td>" . $resultado['plan'] . "</td>";
                    $html .= "<td>" . $resultado['nroafiliado'] . "</td>";
                    $html .= "<td hidden>" . $resultado['valor'] . "</td>";
                    $html .= "</tr>";
                }
            }
        } elseif ($medico !== 'Todos') {
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

            if (isset($resultados) && !empty($resultados)) {
                foreach ($resultados as $resultado) {
                    // Acceder a la información del turno
                    // ... acceder a los demás campos del turno según sea necesario

                    $html .= '<tr data-idturno="' . $resultado['id_turno'] . '">';
                    $html .= "<td>" . $resultado['medico'] . "</td>";
                    $html .= "<td>" . $resultado['fecha_turno'] . "</td>";
                    $html .= "<td>" . $resultado['hora_turno'] . "</td>";
                    $html .= "<td>" . $resultado['nombre'] . " " . $resultado['apellido'] . "</td>";
                    $html .= "<td>" . $resultado['telefono'] . "</td>";
                    $html .= "<td>" . $resultado['obra_social'] . "</td>";
                    $html .= "<td>" . $resultado['plan'] . "</td>";
                    $html .= "<td>" . $resultado['nroafiliado'] . "</td>";
                    $html .= "<td hidden>" . $resultado['valor'] . "</td>";
                    $html .= "</tr>";
                }
            } else {
                $html .= "<tr>";
                $html .= "<td colspan='8'>No se encontraron resultados para este médico.</td>";
                $html .= "</tr>";
            }
        } else {
            $html .= "<tr>";
            $html .= "<td colspan='8'>No se seleccionó un médico válido.</td>";
            $html .= "</tr>";
        }
    } catch (PDOException $e) {
        echo "Error al ejecutar la consulta: " . $e->getMessage();
    }
} if (isset($_POST['fecha'])) {

$fecha = $_POST['fecha'];

    try {
        
        // Crear conexión PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar la consulta para obtener los turnos de la fecha
        $consulta = "SELECT t.*, u.nombre, u.apellido, u.telefono, u.obra_social, u.nroafiliado, u.plan
                     FROM turnos t
                     JOIN usuarios u ON t.id_usuario = u.id
                     WHERE t.fecha_turno = :fecha";

        $stmt = $conn->prepare($consulta);

        $stmt->bindParam(':fecha', $fecha);
        
        $stmt->execute();

        // Obtener los resultados de la consulta
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        

        if (isset($resultados) && !empty($resultados)) {
            foreach ($resultados as $resultado) {
                // Acceder a la información del turno
                // ... acceder a los demás campos del turno según sea necesario

                $html .= '<tr data-idturno="' . $resultado['id_turno'] . '">';
                $html .= "<td>" . $resultado['medico'] . "</td>";
                $html .= "<td>" . $resultado['fecha_turno'] . "</td>";
                $html .= "<td>" . $resultado['hora_turno'] . "</td>";
                $html .= "<td>" . $resultado['nombre'] . " " . $resultado['apellido'] . "</td>";
                $html .= "<td>" . $resultado['telefono'] . "</td>";
                $html .= "<td>" . $resultado['obra_social'] . "</td>";
                $html .= "<td>" . $resultado['plan'] . "</td>";
                $html .= "<td>" . $resultado['nroafiliado'] . "</td>";
                $html .= "<td hidden>" . $resultado['valor'] . "</td>";
                $html .= "</tr>";
            }
        } else {
            $html .= "<tr>";
            $html .= "<td colspan='8'>No se encontraron resultados para esta fecha.</td>";
            $html .= "</tr>";
        }
               

    } catch (PDOException $e) {
        echo "Error al ejecutar la consulta: " . $e->getMessage();
    }
}

// Cerrar la conexión
$conn = null;
echo $html;
