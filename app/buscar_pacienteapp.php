<?php
session_start();
include_once 'conexion.php';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Obtener los valores del formulario
$nombre_apellido = $_POST["nombre_apellido"];
$dni = $_POST["dni"];
$direccion = $_POST["direccion"];

// Construir la consulta SQL para buscar al paciente
$consulta = "SELECT nombre, apellido, dni, direccion, localidad, telefono, fecha_nacimiento, obra_social, nroafiliado, plan, mail, fecha_alta 
             FROM usuarios
             WHERE nombre LIKE '$nombre_apellido' OR apellido LIKE '$nombre_apellido' OR dni = '$dni' OR direccion LIKE '$direccion'";

// Ejecutar la consulta SQL
$resultado = $conn->query($consulta);

// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    // Recorrer los resultados y mostrar la información de los pacientes
    while ($paciente = $resultado->fetch_assoc()) {
        $_SESSION ['nombre'] = $paciente["nombre"];
        $_SESSION ['apellido'] = $paciente["apellido"];
        $_SESSION ['dni'] = $paciente["dni"];
        $_SESSION ['direccion'] = $paciente["direccion"];
        $_SESSION ['localidad'] = $paciente["localidad"];
        $_SESSION ['telefono'] = $paciente["telefono"];
        $_SESSION ['fecha_nacimiento'] = $paciente["fecha_nacimiento"];
        $_SESSION ['obra_social'] = $paciente["obra_social"];
        $_SESSION ['nroafiliado'] = $paciente["nroafiliado"];
        $_SESSION ['plan'] = $paciente["plan"];
        $_SESSION ['mail'] = $paciente["mail"];
        $_SESSION ['fecha_alta'] = $paciente["fecha_alta"];
        }
        header("Location: ..\informacionpaciente.php");

}   
    else {
            echo "No se encontraron resultados.";
         }

// Cerrar la conexión
$conn->close();


?>