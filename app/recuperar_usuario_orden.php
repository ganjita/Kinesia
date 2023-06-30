<?php
include_once 'conexion.php';

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

$term = $_GET['term'];

// Realizar la consulta en la base de datos para buscar coincidencias exactas
// Reemplaza 'usuarios' con el nombre de tu tabla de usuarios y los campos correspondientes
$query = "SELECT * FROM usuarios WHERE apellido = '$term' OR nombre = '$term'";
$result = mysqli_query($conn, $query);

// Crear un array para almacenar los resultados
$usuarios = array();

// Recorrer los resultados de la consulta y almacenar los datos en el array
while ($row = mysqli_fetch_assoc($result)) {
    $usuarios[] = array(
        'id' => $row['id'],
        'nombre' => $row['nombre'],
        'apellido' => $row['apellido'],
        'dni' => $row['dni'], // Agregar el campo 'dni'
        'obra_social' => $row['obra_social']
        // Agrega otros campos que desees incluir en el autocompletado
    );
}

// Devolver los resultados en formato JSON
echo json_encode($usuarios);
?>
