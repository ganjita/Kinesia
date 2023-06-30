<?php

include_once 'plantillas\navmenu.inc.php'

?>
<!-- Presentación principal -->
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="display-4" style="margin-top: 30px;">Bienvenido al Instituto KINESIA</h1>
        <p class="lead">Somos especialistas en kinesiología y rehabilitación</p>
        <a href="#especialidades" class="btn btn-primary">Conoce nuestros servicios</a>
        <a href="#nuestrosmedicos" class="btn btn-primary">Conoce nuestros Medicos</a>
        <br>
        <hr style="margin-top: 40px;">
        <br>
    </div>
</section>

<!-- Sección de imágenes con texto -->
<section class="container">
    <div class="row">
        <div class="col-md-6 section-image">
            <img src="img/frente.jpg" alt="Imagen 1">
            <div class="section-content">
                <h2>Título de la sección 1</h2>
                <p>Descripción de la sección 1 Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>
        <div class="col-md-6 section-image">
            <img src="img/entrada.jpg" alt="Imagen 2">
            <div class="section-content">
                <h2>Título de la sección 2</h2>
                <p>Descripción de la sección 2 Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>
    </div>
</section>
<hr style="margin-top: 40px;">

<!-- Sección de especialidades -->
<section class="bg-light py-5 specialties">
    <div class="container" id="especialidades">
        <h2 class="text-center">Nuestras Especialidades</h2>
        <br>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Traumatología</h3>
                        <p class="card-text">Descripción de la especialidad 1 Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p class="card-text">Instrumentos utilizados: Instrumento 1, Instrumento 2</p>
                        <p class="card-text">Profesionales: Nombre 1, Nombre 2</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Kinesioterapia</h3>
                        <p class="card-text">Descripción de la especialidad 2 Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p class="card-text">Instrumentos utilizados: Instrumento 3, Instrumento 4</p>
                        <p class="card-text">Profesionales: Nombre 3, Nombre 4</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Kinesiologia-Deportiva 3</h3>
                        <p class="card-text">Descripción de la especialidad 3 Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p class="card-text">Instrumentos utilizados: Instrumento 5, Instrumento 6</p>
                        <p class="card-text">Profesionales: Nombre 5, Nombre 6</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<hr style="margin-top: 40px;">


<!-- Sección de médicos -->
<section class="container py-5 doctors" id="nuestrosmedicos">
    <h2 class="text-center">Nuestros Médicos</h2>
    <br>
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card conimagen">
                <img src="img/doc1.jpg" alt="Doctor 1" class="card-img-top">
                <div class="card-body">
                    <h4 class="card-title">Pekar Emiliano</h4>
                    <p class="card-text">Nro de Matrícula: MP3687</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card conimagen">
                <img src="img/doc2.jpg" alt="Doctor 2" class="card-img-top">
                <div class="card-body">
                    <h4 class="card-title">Camejo Andrea</h4>
                    <p class="card-text">Nro de Matrícula: MP4134</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card conimagen">
                <img src="img/doc3.jpg" alt="Doctor 3" class="card-img-top">
                <div class="card-body">
                    <h4 class="card-title">Lapolla Solange</h4>
                    <p class="card-text">Nro de Matrícula: MP5301</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card conimagen">
                <img src="img/doc4.jpg" alt="Doctor 4" class="card-img-top">
                <div class="card-body">
                    <h4 class="card-title">Tristan Ariel</h4>
                    <p class="card-text">Nro de Matrícula: MP6526</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card conimagen">
                <img src="img/doc5.jpg" alt="Doctor 5" class="card-img-top">
                <div class="card-body">
                    <h4 class="card-title">Miranda Federico</h4>
                    <p class="card-text">Nro de Matrícula: MP8362</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card conimagen">
                <img src="img/doc6.jpg" alt="Doctor 6" class="card-img-top">
                <div class="card-body">
                    <h4 class="card-title">Biscaysaqu Pablo</h4>
                    <p class="card-text">Nro de Matrícula: MP7438</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card conimagen">
                <img src="img/doc7.jpg" alt="Doctor 7" class="card-img-top">
                <div class="card-body">
                    <h4 class="card-title">Petrarca Gonzalo</h4>
                    <p class="card-text">Nro de Matrícula: MP8411</p>
                </div>
            </div>
        </div>
    </div>
</section>

<hr style="margin-top: 40px;">

<!--Seccion de comentarios-->
<div class="container" style="margin-top: 30px;">
    <div class="row">
        <div class="col-4">
            <div class="content-box">
                <div class="comentarios">
                    <h3>Deja tu comentario</h3>
                    <form id="formulario-comentario">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" id="nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="calificacion" class="form-label">Calificación:</label>
                            <div class="rating">
                                <label for="star1" title="1 estrella"><i class="fas fa-star"></i></label>
                                <input type="radio" id="star1" name="calificacion" value="1" hidden>
                                <label for="star2" title="2 estrellas"><i class="fas fa-star"></i></label>
                                <input type="radio" id="star2" name="calificacion" value="2" hidden>
                                <label for="star3" title="3 estrellas"><i class="fas fa-star"></i></label>
                                <input type="radio" id="star3" name="calificacion" value="3" hidden>
                                <label for="star4" title="4 estrellas"><i class="fas fa-star"></i></label>
                                <input type="radio" id="star4" name="calificacion" value="4" hidden>
                                <label for="star5" title="5 estrellas"><i class="fas fa-star"></i></label>
                                <input type="radio" id="star5" name="calificacion" value="5" hidden>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="comentario" class="form-label">Comentario:</label>
                            <textarea id="comentario" class="form-control" required></textarea>
                        </div>
                        <input type="date" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" hidden>
                        <button type="submit" class="btn btn-primary">Dejar comentario</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Agrega aquí los otros elementos de la página -->
        <div class="col-8">
            <div class="container mt-4">
                <h3>Comentarios</h3>

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Comentario 1</h5>
                        <div class="rating">

                            <!-- ... tus estrellas existentes ... -->

                        </div>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <div class="comentario-info">
                            <span class="autor">Nombre del autor</span>
                            <span class="fecha">Fecha del comentario</span>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Comentario 2</h5>
                        <div class="rating">

                            <!-- ... tus estrellas existentes ... -->

                        </div>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci, amet debitis ipsa delectus corporis et, earum, excepturi porro exercitationem veniam cum odit tempora explicabo deleniti repudiandae voluptatibus quam quos eaque?</p>
                        <div class="comentario-info">
                            <span class="autor">Nombre del autor</span>
                            <span class="fecha">Fecha del comentario</span>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Comentario 3</h5>
                        <div class="rating">

                            <!-- ... tus estrellas existentes ... -->

                        </div>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem facilis a aliquid sequi modi nesciunt quaerat inventore eaque.</p>
                        <div class="comentario-info">
                            <span class="autor">Nombre del autor</span>
                            <span class="fecha">Fecha del comentario</span>
                        </div>
                    </div>
                </div>

                <!-- Agrega aquí los otros comentarios -->

            </div>
        </div>
    </div>
</div>
<style>
    .section-image {
        position: relative;
        overflow: hidden;
    }

    .section-image img {
        width: 100%;
        height: auto;
        transition: transform 0.3s ease;
    }

    .section-image:hover img {
        transform: scale(1.1);
    }

    .section-image .section-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 1);
        /* Sombra suave */
    }

    h2 {
        font-size: 2.5rem;
        font-weight: bold;
        color: #333;
    }

    h3 {
        font-size: 1.8rem;
        font-weight: bold;
        color: #333;
    }

    p {
        font-size: 1.2rem;
        color: #666;
    }

    .conimagen {
        width: 200px;
    }

    .card {
        border: none;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        transition: transform 0.3s;
    }



    .card:hover {
        transform: translateY(-5px);
    }

    .card-title {
        font-size: 1.4rem;
        font-weight: bold;
        color: #333;
    }

    .card-text {
        font-size: 1.2rem;
        color: #666;
    }

    .rating {
        color: #FFD700;
    }

    .autor {
        font-size: 1rem;
        color: #666;
    }

    .fecha {
        font-size: 1rem;
        color: #999;
    }

    /* Estilos de la sección de especialidades */
    .specialties {
        background-color: #f8f9fa;
        padding-top: 80px;
        padding-bottom: 80px;
    }

    .specialties h2 {
        margin-bottom: 40px;
    }

    /* Estilos de la sección de médicos */
    .doctors {
        padding-top: 80px;
        padding-bottom: 80px;
    }

    .doctors h2 {
        margin-bottom: 40px;
    }

    /* Estilos de la sección de comentarios */
    .comentarios {
        background-color: #f8f9fa;
        padding: 30px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 1);
    }

    .content-box {
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 1);
    }

    #formulario-comentario {
        margin-bottom: 20px;
    }

    #formulario-comentario label {
        font-weight: bold;
    }

    #formulario-comentario textarea {
        height: 100px;
    }

    .comentario-info {
        margin-top: 10px;
    }
</style>

<?php
include_once 'plantillas/footer.inc.php';
include_once 'plantillas/cierrehtml.inc.php'
?>