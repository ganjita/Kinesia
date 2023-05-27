<?php
include_once 'conexion.php';
session_start();

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}



if (isset($_POST['busqueda'])) {
    $busqueda = $_POST['busqueda'];
    // Utilizar una consulta preparada para evitar la inyección SQL
    $sql = "SELECT id, nombre, apellido, dni, direccion, mail FROM usuarios WHERE nombre = ? OR apellido = ? OR dni = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $busqueda, $busqueda, $busqueda);
    $stmt->execute();
    $result = $stmt->get_result();

    
    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        // Crear un array para almacenar los datos de los pacientes
        $resultados = array();
        
        // Recorrer los resultados y almacenar los datos en el array
        while ($paciente = $result->fetch_assoc()) {
            $resultados[] = $paciente;
        }
        
        
        // Almacenar los resultados en una variable de sesión
        $_SESSION['resultados'] = $resultados;

        
        
        // Redirigir a la página "nuevo_turno.php" con los resultados de la búsqueda
        header("Location: ../nuevo_turno.php");
        exit();
    } else {
      header("Location: ../nuevo_turno.php");
    }
}

// Cerrar la conexión
$conn->close();
?>
