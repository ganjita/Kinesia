<?php
include_once('conexion.php');

///////////////////////////////////////////////
/////ELIMINA UN TURNO DE LA TABLA turnos//////
//////////////////////////////////////////////

$idTurno = $_POST['idTurno']; // Suponiendo que obtienes el valor de idTurno desde un formulario o una solicitud POST

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM turnos WHERE id_turno = :idTurno";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idTurno', $idTurno);

    if ($stmt->execute()) {
        echo "El registro se eliminó correctamente.";
    } else {
        echo "Error al eliminar el registro.";
    }
    
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

?>
