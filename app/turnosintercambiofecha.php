<?php
include_once 'conexion.php';
session_start();


$html = '';

if (isset($_POST['fecha'])) {

    // Obtener los parámetros de fecha y medico enviados por POST
    $fecha = $_POST['fecha'];


    try {
        // Crear conexión PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar la consulta SQL
        $sql = "SELECT t.*, u.nombre, u.apellido, u.telefono, u.obra_social, u.nroafiliado, u.plan
                            FROM turnos t
                            JOIN usuarios u ON t.id_usuario = u.id
                            WHERE fecha_turno = :fecha
                            ORDER BY t.fecha_turno DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':fecha', $fecha);

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
            $html .= "</tr>";
        }
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
    }
}

// Cerrar la conexión
$conn = null;
echo $html;