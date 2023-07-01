<?php
include_once('conexion.php');
session_start();

$html = '';

///////////////////////////////////////////////////////////////
//////CONSULTAS SOBRE TURNOS RELACIONADOS CON LOS USUARIOS////
//////////////////////////////////////////////////////////////



if (isset($_POST['fecha']) && isset($_POST['medico'])) {

    // Obtener los parámetros de fecha y medico enviados por POST
    $fecha = $_POST['fecha'];
    $medico = $_POST['medico'];

    try {
        // Crear conexión PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($medico === "tlm") {
            // Actualiza la consulta SQL para seleccionar todos los turnos de la fecha, sin filtrar por médico
            $sql = "SELECT t.*, u.nombre, u.apellido, u.telefono, u.obra_social, u.nroafiliado, u.plan
                    FROM turnos t
                    JOIN usuarios u ON t.id_usuario = u.id
                    WHERE fecha_turno = :fecha
                    ORDER BY t.fecha_turno DESC, t.hora_turno ASC"; // Ordenar por fecha_turno y hora_turno ascendentes            $stmt = $conn->prepare($sql);
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':fecha', $fecha);
        } else {
            // La consulta SQL original se mantiene para filtrar por fecha y médico
            $sql = "SELECT t.*, u.nombre, u.apellido, u.telefono, u.obra_social, u.nroafiliado, u.plan
                    FROM turnos t
                    JOIN usuarios u ON t.id_usuario = u.id
                    WHERE fecha_turno = :fecha AND id_medico = :medico
                    ORDER BY t.fecha_turno DESC, t.hora_turno ASC"; // Ordenar por fecha_turno y hora_turno ascendentes            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':medico', $medico);
        }

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener los resultados de la consulta
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Mostrar los resultados
        foreach ($resultados as $resultado) {
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
            $html .= '<td data-pagado="" hidden>' . $resultado['pagado'] . '</td>';
            $html .= '<td data-idusuario="" hidden>' . $resultado['id_usuario'] . '</td>';
            $html .= "<td hidden>" . $resultado['id_orden'] . "</td>";
            $html .= "</tr>";
        }
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
    }
}

// Cerrar la conexión
$conn = null;
echo $html;
