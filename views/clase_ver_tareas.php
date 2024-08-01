<iframe src="clases.php" style="display:none;" width="100%" height="1000px"></iframe>
<button id="close-button" style="display:none;">Cerrar</button>
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

    iframe {
        position: fixed;
        /* Fija el iframe a la ventana del navegador */
        top: 0;
        left: 0;
        width: 100vw;
        /* 100% del ancho de la ventana del navegador */
        height: 100vh;
        /* 100% de la altura de la ventana del navegador */
        border: none;
        /* Opcional: quita el borde del iframe */
        z-index: 9999;
    }

    #close-button {
        position: absolute;
        /* Posiciona el botón en relación al iframe */
        top: 90%;
        right: 5%;
        background: red;
        color: white;
        border: none;
        border-radius: 10%;
        text-align: center;
        line-height: 30px;
        cursor: pointer;
        font-size: 16px;
        z-index: 10000;
        /* Asegura que el botón esté encima del iframe */
    }

    .preview-container {
        display: none;
        /* Por defecto oculto */
        align-items: center;
        gap: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        max-width: 300px;
    }

    .preview {
        max-width: 50px;
        max-height: 50px;
    }

    .file-info {
        flex: 1;
        overflow: hidden;
        text-overflow: ellipsis;
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
                        <?php if (isset($recursos) && count($recursos) > 0) {
                            for ($i = 0; $i < count($recursos); $i += 2) { ?>
                                <div class="resource-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-subtitle mb-2 text-muted">Archivo Adjunto</h6>
                                            <p class="card-text">Nombre del archivo: <a href="#" onclick="cargarPdf('<?php echo $recursos[$i] . '.' . $recursos[$i + 1] ?>')"><?php echo $recursos[$i] . "." . $recursos[$i + 1] ?></a></p>
                                            <p class="card-text">
                                                <i class="far fa-file-pdf fa-2x"></i> <!-- Icono de archivo PDF -->
                                            </p>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>

                        <!-- Botones de acción -->
                        <?php if ($clase["id_usuario_creador"] != $_SESSION["usuario"]["id"]) { ?>
                            <div class="mt-4">
                                <a href="#" class="btn btn-primary mr-2"><i class="fas fa-cloud-upload-alt"></i> Subir</a>
                                <a href="#" class="btn btn-success mr-2"><i class="fas fa-check"></i> Marcar como Completada</a>
                            </div>
                        <?php } else { ?>
                            <div class="mt-4 d-flex justify-content-start">
                                <a href="#" class="btn btn-primary mr-2" data-toggle="modal" data-target="#submitModal"><i class="fas fa-edit"></i>Editar</a>
                                <div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="subFmitModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="titulo">Titulo</label>
                                                        <input type="text" class="form-control" name="titulo" maxlength="50" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="instruccion">Instrucciones</label>
                                                        <textarea class="form-control" name="instruccion" rows="4" maxlength="250" required></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="archivo">Selecciona un archivo:</label>
                                                        <input type="file" id="archivo" name="archivo" accept=".pdf, .doc, .docx, .txt" onchange="VistaPrevia()">
                                                        <div id="vista" class="preview-container" onclick="cambiar()">
                                                            <img id="imagen" class="preview" src="#" alt="Vista previa del archivo seleccionado">
                                                            <div id="info" class="file-info" style="pointer-events: none;">Nombre del archivo: </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fecha_limite">Fecha límite</label>
                                                        <input type="datetime-local" class="form-control" name="fecha_limite" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-secondary">Editar</button>
                                                </form>
                                                <script>
                                                    function VistaPrevia() {
                                                        var archivo = document.getElementById('archivo').files[0];
                                                        var vistaPrevContainer = document.getElementById('vista');
                                                        var imagen_previa = document.getElementById('imagen');
                                                        var info_archivo = document.getElementById('info');

                                                        // Limpiar vista previa anterior
                                                        imagen_previa.src = "";
                                                        info_archivo.textContent = "Nombre del archivo: ";

                                                        if (archivo) {
                                                            var lector = new FileReader();
                                                            lector.onload = function(e) {
                                                                vistaPrevContainer.style.display = 'flex';
                                                                document.getElementById('archivo').style.display = 'none'; // Ocultar input de archivo
                                                                if (archivo.type.match('image.*')) {
                                                                    // Mostrar miniatura de imagen
                                                                    imagen_previa.src = e.target.result;
                                                                } else {
                                                                    // Mostrar icono genérico para otros tipos de archivo
                                                                    imagen_previa.src = 'img/literatura.jpg'; // Puedes poner una imagen genérica de archivo
                                                                }
                                                            };
                                                            lector.readAsDataURL(archivo);

                                                            // Mostrar nombre del archivo
                                                            info_archivo.textContent += archivo.name;
                                                        }
                                                    }

                                                    function cambiar() {
                                                        var inputArchivo = document.getElementById('archivo');
                                                        inputArchivo.value = ''; // Limpiar el valor del input
                                                        document.getElementById('vista').style.display = 'none'; // Ocultar la vista previa
                                                        inputArchivo.style.display = 'block'; // Mostrar el input de archivo
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form method="POST">
                                    <button type="submit" name="eliminar" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Eliminar</button>
                                </form>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna para la sección de comentarios -->
        <?php if ($clase["id_usuario_creador"] != $_SESSION["usuario"]["id"]) { ?>

            <div class="col-md-6">
                <div class="comments-section">
                    <h2 class="mb-4">Comentarios</h2>

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
<script>
    function cargarPdf(nom) {
        document.querySelector("iframe").src = "xd.php?tid=<?php echo $tarea["id"]; ?>&nom=" + nom;
        document.querySelector("iframe").style.display = "block";
        document.querySelector("#close-button").style.display = "block";
    }
    document.getElementById('close-button').addEventListener('click', function() {
        document.querySelector("iframe").style.display = 'none';
        this.style.display = 'none'; // Oculta el botón también
    });
</script>