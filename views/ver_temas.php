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
                <h2 class="mb-4">Detalles del Tema</h2>

                <div class="card mb-3">
                    <div class="card-body">
                        <?php if ($tema) { ?>
                            <h5 class="card-title"><?php echo htmlspecialchars($tema["nombre"]); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($tema["descripcion"]); ?></p>
                        <?php } ?>

                        <!-- Mostrar los recursos si existen -->
                        <?php if (isset($recursos) && count($recursos) > 0) {
                            for ($i = 0; $i < count($recursos); $i += 2) { ?>
                                <div class="resource-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-subtitle mb-2 text-muted">Archivo Adjunto</h6>
                                            <p class="card-text">Nombre del archivo: <a href="#"><?php echo htmlspecialchars($recursos[$i]) . '.' . htmlspecialchars($recursos[$i + 1]); ?></a></p>
                                            <p class="card-text">
                                                <i class="far fa-file-pdf fa-2x"></i> <!-- Icono de archivo PDF -->
                                            </p>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>

                        <!-- Botones de acción solo visibles para profesores -->
                        <?php if ($esProfesor): ?>
                            <div class="mt-4">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editTema"><i class="fas fa-edit"></i> Editar</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarTema"><i class="fas fa-trash-alt"></i> Eliminar</button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modales para editar y eliminar -->
        <!-- Modal para editar temas -->
        <div class="modal fade" id="editTema" tabindex="-1" role="dialog" aria-labelledby="editTemaLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTemaLabel">Editar Tema</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <input type="hidden" name="id_tema_editar" value="<?php echo $_GET["tid"]; ?>">
                            <div class="form-group">
                                <label for="nombre">Nombre: </label>
                                <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($tema['nombre']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea name="descripcion" id="descripcion" class="form-control" required><?php echo htmlspecialchars($tema["descripcion"]); ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para eliminar temas -->
        <div class="modal fade" id="eliminarTema" tabindex="-1" role="dialog" aria-labelledby="eliminarTemaLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eliminarTemaLabel">¿Desea eliminar este tema?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <input type="hidden" name="id_tema_eliminar" value="<?php echo $_GET["tid"]; ?>">
                            <button type="submit" class="btn btn-danger">Sí, quiero eliminarlo</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna para la sección de comentarios -->
        <?php if ($clase["id_usuario_creador"] != $usuarioId) { ?>
            <div class="col-md-6">
                <div class="comments-section">
                    <h2 class="mb-4">Comentarios</h2>

                    <!-- Formulario para agregar comentario -->
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
