<?php require_once "views/clase_navbar.php"; ?>


    <!-- Main Container -->
    <div class="container mt-5">
        <!-- Header -->
        <div class="jumbotron">
            <h1 class="display-4">Tareas</h1>
            <p class="lead">Aquí encontrarás todas las tareas asignadas y podrás enviar tus trabajos.</p>
        </div>

        <!-- Lista de Tareas -->
        <div class="card mb-4">
            <div class="card-header">
                Lista
            </div>
            <div class="card-body">
                <?php for($i = 0; $i < count($tareas); $i++){ ?>                
                <div class="media mb-3">
                    <img src="https://via.placeholder.com/64" class="mr-3" alt="User Avatar">
                    <div class="media-body">
                        <h5 class="mt-0"><?php echo $tareas[$i]["nombre"]?></h5>
                        <p><?php echo $tareas[$i]["descripcion"]; ?></p>
                        <p>Fecha de entrega: <?php echo date('j \d\e F, Y', strtotime($tareas[$i]["fecha_entrega"])); ?></p>
                        <a href="#" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#submitModal">Enviar Tarea</a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Modal para Enviar Tarea -->
    <div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="submitModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submitModalLabel">Enviar Tarea</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="taskTitle">Título de la Tarea</label>
                            <input type="text" class="form-control" id="taskTitle" placeholder="Ingresa el título de la tarea">
                        </div>
                        <div class="form-group">
                            <label for="taskFile">Subir Archivo</label>
                            <input type="file" class="form-control-file" id="taskFile">
                        </div>
                        <div class="form-group">
                            <label for="taskComments">Comentarios</label>
                            <textarea class="form-control" id="taskComments" rows="3" placeholder="Agrega algún comentario (opcional)"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar Tarea</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
