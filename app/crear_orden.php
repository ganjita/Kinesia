<?php
include_once 'conexion.php';

// Verificar si se ha enviado una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados
    if (isset($_POST['fechaOrden'])) {
        $fechaOrden = $_POST['fechaOrden'];
    } elseif (isset($_POST['fechaOrdenModal'])) {
        $fechaOrden = $_POST['fechaOrdenModal'];
    }

    if (isset($_POST['medicoOrden'])) {
        $medicoOrden = $_POST['medicoOrden'];
    } elseif (isset($_POST['medicoOrdenModal'])) {
        $medicoOrden = $_POST['medicoOrdenModal'];
    }

    if (isset($_POST['kinesiologoOrden'])) {
        $kinesiologoOrden = $_POST['kinesiologoOrden'];
    } elseif (isset($_POST['kinesiologoOrdenModal'])) {
        $kinesiologoOrden = $_POST['kinesiologoOrdenModal'];
    }

    if (isset($_POST['sesionesOrden'])) {
        $sesionesOrden = $_POST['sesionesOrden'];
    } elseif (isset($_POST['sesionesOrdenModal'])) {
        $sesionesOrden = $_POST['sesionesOrdenModal'];
    }

    if (isset($_POST['autorizacionOrden'])) {
        $autorizacionOrden = $_POST['autorizacionOrden'];
    } elseif (isset($_POST['autorizacionOrdenModal'])) {
        $autorizacionOrden = $_POST['autorizacionOrdenModal'];
    }

    if (isset($_POST['fechaAutorizacionOrden'])) {
        $fechaAutorizacionOrden = $_POST['fechaAutorizacionOrden'];
    } elseif (isset($_POST['fechaAutorizacionOrdenModal'])) {
        $fechaAutorizacionOrden = $_POST['fechaAutorizacionOrdenModal'];
    }

    if (isset($_POST['mesFacturacion'])) {
        $mesFacturacion = $_POST['mesFacturacion'];
    } elseif (isset($_POST['mesFacturacionOrdenModal'])) {
        $mesFacturacion = $_POST['mesFacturacionOrdenModal'];
    }

    if (isset($_POST['anioFacturacion'])) {
        $anioFacturacion = $_POST['anioFacturacion'];
    } elseif (isset($_POST['anioFacturacionOrdenModal'])) {
        $anioFacturacion = $_POST['anioFacturacionOrdenModal'];
    }

    if (isset($_POST['idUsuarioOrden'])) {
        $idUsuarioOrden = $_POST['idUsuarioOrden'];
    } elseif (isset($_POST['id_usuario_orden_modal'])) {
        $idUsuarioOrden = $_POST['id_usuario_orden_modal'];
    }

    
    if (!empty($_FILES['imagen']['tmp_name']) || !empty($_FILES['imagenOrdenModal']['tmp_name'])) {
        if (!empty($_FILES['imagen']['tmp_name'])) {
            $imagen = $_FILES['imagen'];
        } else {
            $imagen = $_FILES['imagenOrdenModal'];
        }

        // Verificar si no hay errores en la imagen
        if ($imagen['error'] === UPLOAD_ERR_OK) {
            // Obtener información de la imagen
            $nombreImagen = $imagen['name'];
            $tipoImagen = $imagen['type'];
            $rutaTemporalImagen = $imagen['tmp_name'];

            // Validar el tipo de imagen permitido
            $tiposPermitidos = array('image/jpeg', 'image/png');
            if (in_array($tipoImagen, $tiposPermitidos)) {
                // Generar un nombre único para la imagen
                $nombreImagenUnico = uniqid() . '_' . $nombreImagen;

                // Ruta de destino para guardar la imagen (ajusta la ruta según tus necesidades)
                $rutaDestinoImagen = 'C:\xampp\htdocs\Kinesia\img/' . $nombreImagenUnico;

                // Mover la imagen del directorio temporal al directorio de destino
                if (move_uploaded_file($rutaTemporalImagen, $rutaDestinoImagen)) {
                    // Aquí puedes realizar la inserción de la orden en la base de datos
                    // Utiliza sentencias preparadas o consultas parametrizadas para prevenir inyecciones SQL

                    // Ejemplo de inserción usando MySQLi
                    $mysqli = new mysqli($servername, $username, $password, $dbname);

                    // Verificar la conexión
                    if ($mysqli->connect_errno) {
                        die('Error en la conexión a la base de datos: ' . $mysqli->connect_error);
                    }


                    // Preparar la consulta SQL (ajusta la consulta según tus necesidades)
                    $consulta = $mysqli->prepare("INSERT INTO ordenes (id_usuario, fecha_orden, medico_expedicion, kinesiologo, sesiones, autorizacion, fecha_autorizacion, img_autorizacion, mes_facturacion, anio_facturacion, sesiones_restantes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $consulta->bind_param("sssiisssisi", $idUsuarioOrden, $fechaOrden, $medicoOrden, $kinesiologoOrden, $sesionesOrden, $autorizacionOrden, $fechaAutorizacionOrden, $nombreImagenUnico, $mesFacturacion, $anioFacturacion, $sesionesOrden);

                    // Ejecutar la consulta
                    if ($consulta->execute()) {
                        // La orden se ha guardado correctamente
                        $response = array('success' => true, 'message' => 'Orden guardada correctamente');
                        echo json_encode($response);
                    } else {
                        // Hubo un error al guardar la orden
                        $response = array('success' => false, 'message' => 'Error al guardar la orden');
                        echo json_encode($response);
                    }

                    // Cerrar la conexión
                    $mysqli->close();
                } else {
                    // Hubo un error al mover la imagen
                    $response = array('success' => false, 'message' => 'Error al guardar la imagen');
                    echo json_encode($response);
                }
            } else {
                // El tipo de imagen no está permitido
                $response = array('success' => false, 'message' => 'Tipo de imagen no permitido');
                echo json_encode($response);
            }
        } else {
            // Hubo un error en la imagen
            $response = array('success' => false, 'message' => 'Error en la imagen: ' . $imagen['error']);
            echo json_encode($response);
        }
    } else {
        // No se ha enviado una imagen
        // Aquí puedes realizar la inserción de la orden en la base de datos sin incluir la imagen

        // Ejemplo de inserción usando MySQLi
        $mysqli = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($mysqli->connect_errno) {
            die('Error en la conexión a la base de datos: ' . $mysqli->connect_error);
        }

        // Preparar la consulta SQL (ajusta la consulta según tus necesidades)
        $consulta = $mysqli->prepare("INSERT INTO ordenes (id_usuario, fecha_orden, medico_expedicion, kinesiologo, sesiones, autorizacion, fecha_autorizacion, mes_facturacion, anio_facturacion, sesiones_restantes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $consulta->bind_param("sssiisssii", $idUsuarioOrden, $fechaOrden, $medicoOrden, $kinesiologoOrden, $sesionesOrden, $autorizacionOrden, $fechaAutorizacionOrden, $mesFacturacion, $anioFacturacion, $sesionesOrden);

        // Ejecutar la consulta
        if ($consulta->execute()) {
            // La orden se ha guardado correctamente
            $response = array('success' => true, 'message' => 'Orden guardada correctamente');
            echo json_encode($response);
        } else {
            // Hubo un error al guardar la orden
            $response = array('success' => false, 'message' => 'Error al guardar la orden');
            echo json_encode($response);
        }

        // Cerrar la conexión
        $mysqli->close();
    }
} else {
    // No se ha enviado una solicitud POST
    $response = array('success' => false, 'message' => 'No se ha enviado una solicitud POST');
    echo json_encode($response);
}
