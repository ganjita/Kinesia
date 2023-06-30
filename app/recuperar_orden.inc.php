<?php
include_once 'conexion.php';

// Obtén el valor del id_usuario desde la solicitud AJAX
$idUsuario = $_POST['id_usuario'];

// Establecer la conexión a la base de datos usando PDO
$dsn = 'mysql:host=' . $servername . ';dbname=' . $dbname;
$pdo = new PDO($dsn, $username, $password);

// Consulta para obtener las órdenes por id_usuario
$query = "SELECT * FROM ordenes WHERE id_usuario = :idUsuario";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
$stmt->execute();
$ordenes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Generar el código HTML para el select de órdenes
$htmlSelect = '<select class="form-select" id="orden" name="orden">';
$htmlSelect .= '<option value="">Seleccionar Orden</option>';

foreach ($ordenes as $orden) {
    $htmlSelect .= '<option value="' . $orden['id'] . '">' . "Expidio: " . " (" . $orden['medico_expedicion'] . ") " . "Fecha: " . "  (" . $orden['fecha_orden'] . ") " . "Sesiones: " . "  (" . $orden['sesiones'] .")". " " . "Restantes: " . "  (" . $orden['sesiones_restantes'] .")". '</option>';
}

$htmlSelect .= '</select>';

// Devolver el código HTML como respuesta
echo $htmlSelect;
