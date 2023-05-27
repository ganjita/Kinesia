<?php
// Obtén el ID del paciente enviado por la solicitud AJAX
$pacienteId = $_POST['id'];

// Realiza una consulta a la base de datos para obtener los datos del paciente según el ID


// Realizar la consulta a la base de datos para obtener los datos del paciente
$sql = "SELECT id, nombre, apellido, direccion, telefono, mail FROM pacientes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $pacienteId);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    $paciente = $result->fetch_assoc();

    // Rellenar el formulario con los datos del paciente
    $nombre = $paciente['nombre'];
    $apellido = $paciente['apellido'];
    $direccion = $paciente['direccion'];
    $telefono = $paciente['telefono'];
    $mail = $paciente['mail'];

    // Resto del código para mostrar el formulario y rellenar los campos
} else {
    echo "No se encontró ningún paciente con el ID proporcionado.";
}

// Cerrar la conexión
$conn->close();



// Supongamos que obtienes los datos del paciente en un array llamado $datosPaciente
$datosPaciente = array(
  'nombre' => $nombre,
  'apellido' => $apellido,
  'direccion' => $direccion,
  'telefono' => $telefono,
  'email' => $mail
);

// Devuelve los datos del paciente en formato JSON
echo json_encode($datosPaciente);
?>
