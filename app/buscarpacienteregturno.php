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
    $sql = "SELECT id, nombre, apellido, dni, direccion, telefono, obra_social, plan, nroafiliado FROM usuarios WHERE nombre = ? OR apellido = ? OR dni = ?";
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
    } 
    
    else if(isset($_POST['regturno'])) {
        var_dump($_POST);
        $busqueda = $_POST['regturno'];

        $id_usuario = $_POST['id-paciente']; // ID del paciente seleccionado
        $fecha_turno = $_POST['fecha'];
        $hora_turno = $_POST['hora'];
        $id_medico = $_POST['idMedicoSeleccionado'];
        $medico = $_POST['medicoSeleccionado'];
        $motivo = $_POST['motivo'];
        $valor = $_POST['valor-consulta'];
        $pagado = $pagado = isset($_POST['checkpagoturno']) ? 1 : 0;

    

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            // Preparar la consulta SQL para insertar los datos
            $sql = "INSERT INTO turnos (id_usuario, fecha_turno, hora_turno, id_medico, medico, motivo, valor, pagado) 
                     VALUES (:id_usuario, :fecha_turno, :hora_turno, :id_medico, :medico, :motivo, :valor, :pagado)";

            $stmt = $conn->prepare($sql);
        
            // Asignar los valores a los parámetros de la consulta
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->bindParam(':fecha_turno', $fecha_turno);
            $stmt->bindParam(':hora_turno', $hora_turno);
            $stmt->bindParam(':id_medico', $id_medico);
            $stmt->bindParam(':medico', $medico);
            $stmt->bindParam(':motivo', $motivo);
            $stmt->bindParam(':valor', $valor);
            $stmt->bindParam(':pagado', $pagado);
        
            // Ejecutar la consulta
            $stmt->execute();
        
            header('location: ../nuevo_turno.php');
        
        } catch(PDOException $e) {
            echo "Error al insertar datos: " . $e->getMessage();
        }



    }
}

?>