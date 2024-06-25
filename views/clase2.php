<?php ?>

<div><a href="#" data-toggle="modal" data-target="#editPhoto">Config</a></div>
<div class="modal fade" id="editPhoto" tabindex="-1" role="dialog" aria-labelledby="editPhotoLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editPhotoLabel">Editar foto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post">
                            <input type="text" name="bg" placeholder="bgX X=1~10">
                            <input type="submit" name="sub" value="Guardar">
                            </form>
                        </div>
                    </div>
                </div>
            </div>




<!-- Main Container -->
    <div class="container mt-5">
        <!-- Header -->
        <div class="jumbotron" style="background-image:url(img/fondos/<?php echo $fondo['fondo'] ?>);">
            <h1 class="display-4">Matematica</h1>
            <p class="lead">Bienvenidos a la clase de Matematica. Aquí encontrarán todos los materiales y actividades.</p>
            <hr class="my-4">
            <p>Profesor: Gabriel Valera</p>
        </div>

        <!-- Anuncios -->
        <div class="card mb-4">
            <div class="card-header">
                Anuncios Recientes
            </div>
            <div class="card-body">
                <h5 class="card-title">Nuevo Examen</h5>
                <p class="card-text">El próximo lunes tendremos un examen sobre Integrales y Derivadas</p>
                <p class="card-text"><small class="text-muted">Publicado el 25 de mayo, 2024</small></p>
            </div>
        </div>

        <!-- Actividades Recientes -->
        <div class="card mb-4">
            <div class="card-header">
                Actividades Recientes
            </div>
            <div class="card-body">
                <h5 class="card-title">Tarea: Resolver Limites Indeterminados</h5>
                <p class="card-text">Fecha de entrega: 30 de mayo, 2024</p>
                <a href="#" class="btn btn-primary">Ver Tarea</a>
            </div>
        </div>

        <!-- Material de Clase -->
        <div class="card mb-4">
            <div class="card-header">
                Material de Clase
            </div>
            <div class="card-body">
                <h5 class="card-title">Actividades</h5>
                <p class="card-text">Pueden encontrar las Actividades del tema actual en el siguiente enlace.</p>
                <a href="#" class="btn btn-primary">Ver Actividades</a>
            </div>
        </div>

        <!-- Foro de Discusión -->
        <div class="card mb-4">
            <div class="card-header">
                Foro de Aprendizaje
            </div>
            <div class="card-body">
                <h5 class="card-title">Archivos de Enseñanza</h5>
                <p class="card-text">Lean los archivos acerca de Integrales y Derivadas</p>
                <a href="#" class="btn btn-primary">Archivos</a>
            </div>
        </div>

        <!-- Notas -->
        <div class="card mb-4">
            <div class="card-header">
                Notas
            </div>
            <div class="card-body">
                <h5 class="card-title">Calificaciones Recientes</h5>
                <p class="card-text">Consulta tus últimas calificaciones en el siguiente enlace.</p>
                <a href="#" class="btn btn-primary">Ver Notas</a>
            </div>
        </div>
    </div>