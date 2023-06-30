<?php
session_start();
include_once 'conexion.php';
// Obtener los datos enviados en formato JSON
$data = json_decode(file_get_contents('php://input'), true);

try {
    // Crear conexión PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST["nombre_apellido"]) || isset($_POST["dni"]) || isset($_POST["telefono"])) {
        // Obtener los valores del formulario
        $nombre_apellido = $_POST["nombre_apellido"];
        $dni = $_POST["dni"];
        $direccion = $_POST["direccion"];
        $telefono = $_POST["telefono"];
        $resultados = array();

        // Construir la consulta SQL para buscar al paciente
        $consulta = "SELECT id, nombre, apellido, dni, direccion, localidad, telefono, fecha_nacimiento, obra_social, nroafiliado, plan, mail, fecha_alta 
                 FROM usuarios
                 WHERE nombre LIKE :nombre_apellido OR apellido LIKE :nombre_apellido OR dni = :dni OR direccion LIKE :direccion OR telefono LIKE :telefono";

        // Preparar la consulta
        $stmt = $conn->prepare($consulta);

        // Asignar los valores a los parámetros de la consulta
        $stmt->bindValue(':nombre_apellido', $nombre_apellido);
        $stmt->bindValue(':dni', $dni);
        $stmt->bindValue(':direccion', $direccion);
        $stmt->bindValue(':telefono', $telefono);

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
            header("Location: ../buscar_paciente.php");
            exit();
        } else {
            header("Location: ../buscar_paciente.php");
            exit();
        }
    } elseif ($data) {
        $id = $data['id'];
        $datosTurnos = array();
        $datosUsuarios = array();
        $datosImg = array();
        $datosOrdenes = array(); // Array para almacenar las órdenes

        // Primera consulta: Obtener todos los datos de la tabla usuarios
        $consultaUsuarios = "SELECT * FROM usuarios WHERE id = :id";
        $stmtUsuarios = $conn->prepare($consultaUsuarios);
        $stmtUsuarios->bindValue(':id', $id);
        $stmtUsuarios->execute();
        $datosUsuarios = $stmtUsuarios->fetchAll(PDO::FETCH_ASSOC);
        // Almacenar los resultados en una variable de sesión
        $_SESSION['datosUsuarios'] = $datosUsuarios;

        // Segunda consulta: Buscar al paciente y sus turnos
        $consultaTurnos = "SELECT * FROM turnos WHERE id_usuario = :id";
        $stmtTurnos = $conn->prepare($consultaTurnos);
        $stmtTurnos->bindValue(':id', $id);
        $stmtTurnos->execute();
        $datosTurnos = $stmtTurnos->fetchAll(PDO::FETCH_ASSOC);
        // Almacenar los resultados en otra variable de sesión
        $_SESSION['datosTurnos'] = $datosTurnos;

        // Consulta SQL para obtener las imágenes según el usuario_id
        $sql = "SELECT * FROM imagenes WHERE usuario_id = :id";
        $stmtImg = $conn->prepare($sql);
        $stmtImg->bindValue(':id', $id);
        $stmtImg->execute();
        $datosImg = $stmtImg->fetchAll(PDO::FETCH_ASSOC);
        // Almacenar los resultados en otra variable de sesión
        $_SESSION['datosImg'] = $datosImg;

        // Consulta SQL para obtener las órdenes según el usuario_id
        $sqlOrdenes = "SELECT * FROM ordenes WHERE id_usuario = :id";
        $stmtOrdenes = $conn->prepare($sqlOrdenes);
        $stmtOrdenes->bindValue(':id', $id);
        $stmtOrdenes->execute();
        $datosOrdenes = $stmtOrdenes->fetchAll(PDO::FETCH_ASSOC);
        // Almacenar los resultados en otra variable de sesión
        $_SESSION['datosOrdenes'] = $datosOrdenes;

        // Verificar si se encontraron resultados en la segunda consulta
        if (count($datosTurnos) > 0) {
            // Almacenar los resultados en variables de sesión
            $_SESSION['resultados'] = $resultados;
            $_SESSION['datosUsuarios'] = $datosUsuarios;
            $_SESSION['datosTurnos'] = $datosTurnos;
            $_SESSION['datosImg'] = $datosImg;
            $_SESSION['datosOrdenes'] = $datosOrdenes;

            // Redirigir a la página "informacionpaciente.php"
            header("Location: ../informacionpaciente.php");
            exit();
        } else {
            // Redirigir a la página "buscar_paciente.php" si no se encontraron resultados
            header("Location: ../informacionpaciente.php");
            exit();
        }
    }
} catch (PDOException $e) {
    echo "Error al ejecutar la consulta: " . $e->getMessage();
}

// Cerrar la conexión
$conn = null;
