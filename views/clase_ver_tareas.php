<link rel="stylesheet" href="css/tarea.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<body>
    <div class="container">
        <div class="info-tarea">
            <button class="btn btn-outline-success" data-toggle="modal" data-target="#entregarTarea"><i class="fa-solid fa-list-check"></i> Entregar</button>
            <?php if ($_SESSION['usuario']['id'] == $clase['id_usuario_creador']): ?>
                <button class="btn btn-outline-danger" data-toggle="modal" data-target="#eliminarTarea"><i class="fa-solid fa-trash"></i> Eliminar</button>
                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#editTarea"><i class="fa-solid fa-pen-to-square"></i> Editar</button>

            <?php endif ?>
            <h1><?php echo htmlspecialchars($tarea['nombre']); ?></h1>
            <hr>
            <p><?php echo nl2br(htmlspecialchars($tarea['descripcion'])); ?></p>
            <hr>
            <h2>Recursos Adjuntos</h2>
            <ul>
                <?php foreach ($recursos as $recurso): ?>
                    <li>
                        <a href="img/tareas/<?php echo htmlspecialchars($tarea['id']); ?>/<?php echo htmlspecialchars($recurso['nombre'] . '.' . $recurso['extension']); ?>">
                            <?php echo htmlspecialchars($recurso['nombre']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <!-- Estado de la tarea por alumno -->
<h2>Estado de la Tarea por Alumno</h2>
<ul class="list-group">
    <?php foreach ($usuarios as $usuario): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <?php echo htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellido']); ?>
            <span class="badge bg-<?php echo ($usuario['estado'] == 'entregado') ? 'success' : 'warning'; ?>">
                <?php echo ucfirst($usuario['estado']); ?>
            </span>
            <?php if ($usuario['estado'] != 'no entregado'): ?>
                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#verSubida_<?php echo htmlspecialchars($usuario['id']); ?>">Ver Subida</button>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>

<!-- Modal para ver la subida del alumno -->
<?php foreach ($usuarios as $usuario): ?>
    <div class="modal fade" id="verSubida_<?php echo htmlspecialchars($usuario['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="verSubidaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verSubidaLabel">Subida de <?php echo htmlspecialchars($usuario['nombre']); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Aquí iría el contenido de lo que el alumno ha subido, por ejemplo, enlaces o archivos -->
                    <p>Aquí se mostrarán los detalles de la subida de <?php echo htmlspecialchars($usuario['nombre']); ?>.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

        </div>

    </div>
    <!-- <div class="container">

        <div class="comentarios-mensajes">
            <h2>Comentarios</h2>
            <form method="POST">
                <textarea name="comentario" placeholder="Escribe tu comentario..."></textarea>
                <button type="submit" class="btn-enviar">Enviar</button>
            </form>

            <h2>Mensajes Privados</h2>
            <ul>
                <?php foreach ($general as $mensaje): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($mensaje['name']); ?>:</strong>
                        <?php echo nl2br(htmlspecialchars($mensaje['mensaje'])); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div> -->

    <!-- modal eliminar tarea -->
    <div class="modal fade" id="eliminarTarea" tabindex="2" role="dialog" aria-labelledby="eliminarTarea" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminarTarea">¿Desea eliminar esta tarea?</h5>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <button type="submit" class="btn btn-danger">Si, quiero eliminarla</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal editar tarea -->
    <div class="modal fade" id="editTarea" tabindex="1" role="dialog" aria-labelledby="editTarea" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTarea">Editar Tarea</h5>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <label for="nombre">Nombre: </label><br><input type="text" name="nombre_tarea" value="<?php echo $tarea['nombre'] ?>"><br>
                        <label for="descripcion">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" required><?php echo $tarea["descripcion"]; ?></textarea><br>
                        <button type="submit" class="btn btn-danger">Actualizar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal entrargar tareas -->
    <div class="modal fade" id="entregarTarea" tabindex="-1" role="dialog" aria-labelledby="entregarTarea" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="entregarTarea">Entregar tarea</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="opcionEntrega" id="marcarEntregada" value="marcar" checked>
                            <label class="form-check-label" for="marcarEntregada">
                                Marcar como entregada
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="opcionEntrega" id="entregarArchivo" value="archivo">
                            <label class="form-check-label" for="entregarArchivo">
                                Entregar con archivo adjunto
                            </label>
                        </div>

                        <div class="form-group mt-3" id="fileUpload" style="display: none;">
                            <label for="archivoAdjunto">Subir archivo</label>
                            <input type="file" class="form-control-file" id="archivoAdjunto" name="archivoAdjunto">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('entregarArchivo').addEventListener('change', function() {
            document.getElementById('fileUpload').style.display = 'block';
        });
        document.getElementById('marcarEntregada').addEventListener('change', function() {
            document.getElementById('fileUpload').style.display = 'none';
        });
    </script>

</body>