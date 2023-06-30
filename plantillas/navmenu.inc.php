<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Instituto de Kinesiología</title>
<link rel="stylesheet" href="estilos.css">
  <!-- Agregar el CDN de bootstrap 5 -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.10/dist/sweetalert2.min.css" integrity="sha256-3Rcp1SEeC4XehtbH5UhZ2lYMlPfanMAjhcyh/Dwu1Ac=" crossorigin="anonymous">

</head>

<body>
  <!--MENU Y BARRA DE NAVEGACION-->
  <header>
    <!-- Usar el componente navbar de bootstrap 5 -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <div class="logo">
          <a class="navbar-brand" href="index.php">
            <img class="imglogo" src="img\logo.png" alt="KINESIA">
          </a>
          <h1 style="color: #ddd; text-shadow: 0 0 10px #6accd9, 0 0 20px #6accd9, 0 0 30px #6accd9;">KINESIA</h1>
        </div>
        <!-- Agregar el botón de toggler para dispositivos móviles -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Colapsar el menú en un contenedor -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="index.php">INICIO</a></li>
            <li class="nav-item"><a class="nav-link" href="registrar_paciente.php">REGISTRAR PACIENTE</a></li>
            <li class="nav-item"><a class="nav-link" href="buscar_paciente.php">BUSCAR PACIENTE</a></li>
            <li class="nav-item"><a class="nav-link" href="nueva_orden.php">REGISTRAR ORDEN</a></li>
            <li class="nav-item"><a class="nav-link" href="nuevo_turno.php">REGISTRAR TURNO</a></li>
            <li class="nav-item"><a class="nav-link" href="turnos_medico.php">TURNOS MEDICO</a></li>
          </ul>
          <!-- Alinear el botón de iniciar sesión a la derecha -->
          <div class="d-flex ms-auto">
            <a href="iniciar_sesion.html" class="btn btn-primary login-btn">Iniciar Sesión</a>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <main>