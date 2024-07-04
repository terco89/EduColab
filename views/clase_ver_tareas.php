<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome (para los iconos) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
    /* Estilos adicionales para personalizar la apariencia */
    .task-details {
        max-width: 600px;
        margin: auto;
        padding: 20px;
    }

    .comment {
        margin-bottom: 15px;
    }

    .comments-section {
        max-width: 600px;
        margin: auto;
        padding: 20px;
    }
</style>
<div class="container mt-4">
    <div class="row">
        <!-- Columna para los detalles de la tarea -->
        <div class="col-md-6">
            <div class="task-details">
                <h2 class="mb-4">Detalles de Tarea</h2>

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $tarea["nombre"] ?></h5>
                        <p class="card-text"><?php echo $tarea["descripcion"] ?></p>
                        <p class="card-text"><strong>Fecha límite:</strong> <?php echo $tarea["fecha_entrega"] ?></p>
                        <?php if (isset($recursos) &&  count($recursos) > 0) {
                            for ($i = 0; $i < count($recursos); $i += 2) { ?>
                                <div class="resource-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-subtitle mb-2 text-muted">Archivo Adjunto</h6>
                                            <p class="card-text">Nombre del archivo: <a href="#"><?php echo $recursos[$i] . $recursos[$i+1] ?></a></p>
                                            <p class="card-text">
                                                <i class="far fa-file-pdf fa-2x"></i> <!-- Icono de archivo PDF -->
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Puedes agregar más recursos aquí -->
                                </div>
                        <?php }
                        } ?>

                        <!-- Botones de acción -->
                        <?php if ($result["id_usuario_creador"] != $_SESSION["usuario"]["id"]) { ?>
                            <div class="mt-4">
                                <a href="#" class="btn btn-primary mr-2"><i class="fas fa-cloud-upload-alt"></i> Subir</a>o
                                <a href="#" class="btn btn-success mr-2"><i class="fas fa-check"></i> Marcar como Completada</a>
                            </div>
                        <?php } else { ?>
                            <div class="mt-4">
                                <a href="#" class="btn btn-primary mr-2"><i class="fas fa-edit"></i> Editar</a>
                                <a href="#" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Eliminar</a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna para la sección de comentarios -->
        <?php if ($result["id_usuario_creador"] != $_SESSION["usuario"]["id"]) { ?>

            <div class="col-md-6">
                <div class="comments-section">
                    <h2 class="mb-4">Comentarios</h2>

                    <!-- Lista de Comentarios -->
                    <!--<div class="comment">
          <strong>José Martínez:</strong>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam suscipit metus at aliquet efficitur.</p>
        </div>-->

                    <!-- Formulario para Agregar Comentario -->
                    <form>
                        <div class="form-group">
                            <label for="commentContent">Comentario:</label>
                            <textarea class="form-control" id="commentContent" rows="3" placeholder="Escribe tu comentario"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-comment"></i> Añadir Comentario</button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
</div>