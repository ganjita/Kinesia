<!DOCTYPE html>
<html lang="es">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Instituto de Kinesiología</title>
 <link rel="stylesheet" href="estilos.css">
 <!-- Agregar el CDN de bootstrap 5 -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
 <!--MENU Y BARRA DE NAVEGACION-->
 <header>
 <!-- Usar el componente navbar de bootstrap 5 -->
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
 <div class="container-fluid">
 <div class="logo">
 <a class="navbar-brand" href="index.php">
 <img class="imglogo" src="img\logo.png" alt="KINESIA">
 </a>
 <h1>KINESIA</h1>
 </div>
 <!-- Agregar el botón de toggler para dispositivos móviles -->
 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
 <span class="navbar-toggler-icon"></span>
 </button>
 <!-- Colapsar el menú en un contenedor -->
 <div class="collapse navbar-collapse" id="navbarSupportedContent">
 <ul class="navbar-nav me-auto mb-2 mb-lg-0">
 <li class="nav-item"><a class="nav-link" href="registrar_paciente.php">REGISTRAR PACIENTE</a></li>
 <li class="nav-item"><a class="nav-link" href="buscar_paciente.php">BUSCAR PACIENTE</a></li>
 <li class="nav-item"><a class="nav-link" href="nuevo_turno.php">REGISTRAR TURNO</a></li>
 <li class="nav-item"><a class="nav-link" href="turnos_medico.php">TURNOS MEDICO</a></li>
 <!-- Usar el componente dropdown de bootstrap 5 -->
 <li class="nav-item dropdown">
  <a
    class="nav-link dropdown-toggle"
    href="#"
    id="navbarDropdown"
    role="button"
    data-bs-toggle="dropdown"
    aria-expanded="false"
    >MEDICO</a
  >
  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
    <li><a class="dropdown-item">Juan Perez</a></li>
    <li><a class="dropdown-item">Esteban Quito</a></li>
    <li><a class="dropdown-item">Sebastian Cero</a></li>
    <li><a class="dropdown-item">Manuel Quintana</a></li>
  </ul>
</li>
 </ul>
 <!-- Alinear el botón de iniciar sesión a la derecha -->
 <div class="d-flex ms-auto">
 <a href="iniciar_sesion.html" class="btn btn-primary login-btn">Iniciar Sesión</a>
 </div>
 </div>
 </div>
 </nav>
 </header>