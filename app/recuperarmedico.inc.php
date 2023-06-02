<?php
/////////////////////////////////////////////////////////////
/////archivo que se incluye para traer la base de datos//////
/////de medicos y guardarla en $medicos//////////////////////

include_once 'conexion.php';

// Crear conexión PDO
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Construir la consulta SQL para obtener los médicos
$consultaMedicos = "SELECT id, nombre, apellido, telefono FROM medicos";
$stmtMedicos = $conn->prepare($consultaMedicos);
$stmtMedicos->execute();
$medicos = $stmtMedicos->fetchAll(PDO::FETCH_ASSOC);

// Cerrar la conexión
$conn = null;
