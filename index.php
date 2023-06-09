<?php

include_once 'plantillas\navmenu.inc.php'

?>
<!--Secciones del index-->
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


<?php
include_once 'plantillas/footer.inc.php';

include_once 'plantillas/cierrehtml.inc.php'

?>