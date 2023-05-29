<?php
session_start();
include_once 'conexion.php';

try {
    // Crear conexión PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Obtener los valores del formulario
    $nombre_apellido = $_POST["nombre_apellido"];
    $dni = $_POST["dni"];
    $direccion = $_POST["direccion"];
    $resultados = array();
    
    // Construir la consulta SQL para buscar al paciente
    $consulta = "SELECT nombre, apellido, dni, direccion, localidad, telefono, fecha_nacimiento, obra_social, nroafiliado, plan, mail, fecha_alta 
                 FROM usuarios
                 WHERE nombre LIKE :nombre_apellido OR apellido LIKE :nombre_apellido OR dni = :dni OR direccion LIKE :direccion";
    
    // Preparar la consulta
    $stmt = $conn->prepare($consulta);
    
    // Asignar los valores a los parámetros de la consulta
    $stmt->bindParam(':nombre_apellido', $nombre_apellido);
    $stmt->bindParam(':dni', $dni);
    $stmt->bindParam(':direccion', $direccion);
    
    // Ejecutar la consulta
    $stmt->execute();

    // Obtener los resultados de la consulta
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Obtener el número de filas
    $numFilas = count($resultados);

    // Verificar si se encontraron resultados
    if ($numFilas > 0) {
    // Almacenar los resultados en variables de sesión
        $_SESSION['resultados'] = $resultados;

    // Redirigir a la página "informacionpaciente.php"
    header("Location: ../informacionpaciente.php");
    exit();
    } else {
        echo "No se encontraron resultados.";
    }
} catch (PDOException $e) {
    echo "Error al ejecutar la consulta: " . $e->getMessage();
}

// Cerrar la conexión
$conn = null;
?>
