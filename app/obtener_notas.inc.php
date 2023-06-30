<?php

// Función para obtener las notas desde la base de datos
function obtenerNotasDesdeBD($usuarioId)
{
  require 'conexion.php';
  // Crear conexión PDO
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  try {

    // Preparar la consulta SQL para obtener las notas del usuario
    $consulta = $conn->prepare('SELECT * FROM notas WHERE id_usuario = :usuarioId');

    // Asignar el valor del parámetro
    $consulta->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);

    // Ejecutar la consulta
    $consulta->execute();

    // Obtener todas las filas como un array asociativo
    $notas = $consulta->fetchAll(PDO::FETCH_ASSOC);

    // Cerrar la conexión a la base de datos
    $conn = null;

    // Retornar las notas obtenidas
    return $notas;

  } catch (PDOException $e) {
    // Manejar el error de conexión a la base de datos
    echo 'Error de conexión a la base de datos: ' . $e->getMessage();
    return null;
  }
}

?>