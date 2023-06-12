<?php
include_once 'conexion.php';

// cargar_imagenes.php


if (isset($_POST['idUsuario']) && isset($_FILES['file']) && isset($_POST['filePath']) && isset($_POST['fileName'])) {
    $idUsuario = $_POST['idUsuario'];
    $file = $_FILES['file'];
    $filePath = $_POST['filePath'];
    $fileName = $_POST['fileName'];
    
    
    // Aquí puedes realizar la consulta para cargar los datos en la tabla 'imagenes'
    
    // Ejemplo de consulta utilizando PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $stmt = $pdo->prepare('INSERT INTO imagenes (usuario_id, nombre_archivo, ruta_archivo) VALUES (:idUsuario, :fileName, :filePath)');
    $stmt->bindValue(':idUsuario', $idUsuario);
    $stmt->bindValue(':fileName', $fileName);
    $stmt->bindValue(':filePath', $filePath);
    $stmt->execute();
    
    // Puedes enviar una respuesta al cliente si es necesario
    echo 'Carga de imagen exitosa';
} else {
    // Error en los datos recibidos
    echo 'Error al recibir los datos';
}
?>


