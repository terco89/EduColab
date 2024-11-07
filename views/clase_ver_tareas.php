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

    .navbar button {
        background-color: white;
        color: black;
        padding: 14px 20px;
        border: none;
        cursor: pointer;
        float: left;
        font-size: 16px;
    }

    .navbar button:hover {
        background-color: #ccc;
    }

    .content {
        padding: 20px;
    }

    .hidden {
        display: none;
    }
</style>

<?php if ($clase["id_usuario_creador"] == $_SESSION["usuario"]["id"]) { ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <button onclick="showContent('content1')">Instrucciones</button>
                </li>
                <li class="nav-item">
                    <button onclick="showContent('content2')">Trabajo del estudiante</button>
                </li>
                <?php if ($_SESSION["usuario"]["id"] == $clase["id_usuario_creador"]) { ?>

                    <li class="nav-item">
                        <button onclick="showContent('content3')">Comentarios del estudiante</button>
                    </li>
                </ul>
            <?php } ?>
        </div>
    </nav>
<?php } ?>
<script>
    // Función para mostrar el contenido seleccionado
    function showContent(contentId) {
        // Ocultar todos los contenidos
        var contents = document.querySelectorAll('.content');
        contents.forEach(function (content) {
            content.classList.add('hidden');
        });

        // Mostrar el contenido seleccionado
        var selectedContent = document.getElementById(contentId);
        selectedContent.classList.remove('hidden');
    }

    // Mostrar el primer contenido por defecto
    document.addEventListener("DOMContentLoaded", function () {
        showContent('content1'); // Aquí defines cuál contenido mostrar por defecto
    });
</script>
<div class="container mt-4">
    <div class="content hidden" id="content1">
        <div class="row">
            <!-- Columna para los detalles de la tarea -->
            <div class="col-md-6">
                <div class="task-details">
                    <h2 class="mb-4">Detalles de Tarea</h2>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $tarea["nombre"] ?></h5>
                            <p class="card-text"><?php echo $tarea["descripcion"] ?></p>
                            <p class="card-text"><strong>Fecha límite:</strong> <?php echo $fecha['fecha_entrega'] ?>
                            </p>
                            <?php if (isset($recursos) && count($recursos) > 0) {
                                for ($i = 0; $i < count($recursos); $i += 2) { ?>
                                    <div class="resource-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-subtitle mb-2 text-muted">Archivo Adjunto</h6>
                                                <p class="card-text">Nombre del archivo: <a href="#"
                                                        onclick="cargarPdf('<?php echo $recursos[$i] . '.' . $recursos[$i + 1] ?>')"><?php echo $recursos[$i] . "." . $recursos[$i + 1] ?></a>
                                                </p>
                                                <p class="card-text">
                                                    <i class="far fa-file-pdf fa-2x"></i> <!-- Icono de archivo PDF -->
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            } ?>

                            <!-- Botones de acción -->
                            <?php if (!$esProfesor) { ?>
                                <div class="mt-4 d-flex justify-content-start">
                                    <?php if (!isset($entrega)) { ?><a href="#" class="btn btn-primary mr-2"
                                            data-toggle="modal" data-target="#submitModal"><i
                                                class="fas fa-cloud-upload-alt"></i> Subir</a>
                                        <a href="#" class="btn btn-success mr-2"><i class="fas fa-check"></i> Marcar como
                                            Completada</a>
                                    <?php } else { ?>
                                        <p>La tarea fue enviada</p>
                                    <?php } ?>
                                    <div class="modal fade" id="submitModal" tabindex="-1" role="dialog"
                                        aria-labelledby="subFmitModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form
                                                        action="clase_ver_tarea.php?id=<?php echo $_GET["id"]; ?>&tid=<?php echo $_GET["tid"]; ?>"
                                                        method="POST" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="archivo">Selecciona un archivo:</label>
                                                            <input type="file" id="archivoEntrega" name="archivoEntrega"
                                                                accept=".pdf, .doc, .docx, .txt" onchange="VistaPrevia()">
                                                            <div id="vista" class="preview-container" onclick="cambiar()">
                                                                <img id="imagen" class="preview" src="#"
                                                                    alt="Vista previa del archivo seleccionado">
                                                                <div id="info" class="file-info"
                                                                    style="pointer-events: none;">Nombre del archivo: </div>
                                                            </div>
                                                        </div>
                                                        <button type="submit" name="submit"
                                                            class="btn btn-secondary">Listo!</button>
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
                                                                lector.onload = function (e) {
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
                                </div>
                            <?php } else { ?>
                                <div class="mt-4 d-flex justify-content-start">
                                    <a href="#" class="btn btn-primary mr-2" data-toggle="modal"
                                        data-target="#submitModal"><i class="fas fa-edit"></i>Editar</a>
                                    <div class="modal fade" id="submitModal" tabindex="-1" role="dialog"
                                        aria-labelledby="subFmitModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="titulo">Titulo</label>
                                                            <input type="text" value="<?php echo $tarea["nombre"] ?>"
                                                                class="form-control" name="titulo" maxlength="50" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="instruccion">Instrucciones</label>
                                                            <textarea class="form-control"
                                                                value="<?php echo $tarea["descripcion"]; ?>"
                                                                name="instruccion" rows="4" maxlength="250"
                                                                required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="archivo">Selecciona un archivo:</label>
                                                            <input type="file" id="archivo" name="archivo"
                                                                accept=".pdf, .doc, .docx, .txt" onchange="VistaPrevia()">
                                                            <div id="vista" class="preview-container" onclick="cambiar()">
                                                                <img id="imagen" class="preview" src="#"
                                                                    alt="Vista previa del archivo seleccionado">
                                                                <div id="info" class="file-info"
                                                                    style="pointer-events: none;">Nombre del archivo: </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="fecha_limite">Fecha límite</label>
                                                            <input type="datetime-local" class="form-control"
                                                                name="fecha_limite"
                                                                value="<?php echo $tarea["fecha_entrega"]; ?>" required>
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
                                                                lector.onload = function (e) {
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
                                        <button type="submit" name="eliminar" class="btn btn-danger"><i
                                                class="fas fa-trash-alt"></i> Eliminar</button>
                                    </form>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Columna para la sección de comentarios -->
            <?php if ($_SESSION["usuario"]["id"] != $clase["id_usuario_creador"]) { ?>
                <div class="col-md-6">
                    <div class="comments-section">
                        <h2 class="mb-4">Comentarios</h2>

                        <!-- Formulario para Agregar Comentario -->
                        <form method="POST"
                            action="clase_ver_tarea.php?id=<?php echo $_GET["id"]; ?>&tid=<?php echo $_GET["tid"]; ?>">
                            <div class="form-group">
                                <label for="commentContent">Comentario:</label>
                                <textarea class="form-control" name="comentario" id="commentContent" rows="3"
                                    placeholder="Escribe tu comentario" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-comment"></i> Añadir
                                Comentario</button>
                        </form>
                    </div>
                    <div class="comment-box border p-3 mb-3">
                        <?php

                        $query = "SELECT * FROM mensajes_privado WHERE tarea_id = " . $_GET["tid"] . " AND (usuario_id = " . $_SESSION["usuario"]["id"] . " OR usuario_id = " . $clase["id_usuario_creador"] . ") ORDER BY fecha_creacion ASC";
                        $result = mysqli_query($link, $query);
                        $nombre = mysqli_fetch_assoc(mysqli_query($link, "SELECT name FROM usuarios WHere id = " . $clase["id_usuario_creador"]));

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Determinar la clase basada en el usuario
                                $user_class = ($row['bandera'] == false) ? 'left' : 'right';
                                $container_class = ($row['bandera'] == false) ? 'left' : 'right';
                                $nombre_class = ($row['bandera'] == true) ? $_SESSION["usuario"]["name"] : $nombre["name"];

                                echo '<div class="comment-container ' . $container_class . '" style="text-align:' . $container_class . ';" >';
                                echo '<div class="comment ' . $user_class . '">';
                                echo '<strong>' . htmlspecialchars($nombre_class) . '</strong> ';
                                echo '<p>' . htmlspecialchars($row['mensaje']) . '</p>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>No hay comentarios aún.</p>';
                        }
                        ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="content hidden" id="content2">
        <div class="row" style="display: flex; flex-direction: column; gap: 1rem;">
            <?php foreach ($usuarios as $usuario) { ?>
                <div class="card mb-4">
                    <div class="card-body"
                        style="width: 100%; border: 1px solid #ddd; border-radius: 0.25rem; box-shadow: 0 0 1rem rgba(0, 0, 0, 0.1); padding: 1rem; display: flex; flex-direction: column;">
                        <div class="media mb-3" style="display: flex; align-items: center;">
                            <img src="img/foto_perfil/<?php echo $usuario['img']; ?>"
                                style="margin-right: 1.5rem; border-radius:50%; width:2rem; height:2rem;  object-fit: cover; background-color:white;"
                                class="profile">
                            <div class="media-body">
                                <h5 class="truncate"
                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 350px;">
                                    <?php echo $usuario["nombre"] ?>     <?php echo $usuario["apellido"] ?></h5>
                                <h5 style="color: red"><?php if ($usuario["estado"] == 1) {
                                    echo "Sin entregar";
                                } ?></h5>
                                <h5 style="color:green"><?php if ($usuario["estado"] == 2) {
                                    echo "Entregado";
                                } ?></h5>
                                <?php if (isset($recursos2)) {
                                    foreach($recursos2 as $r){
                                        if($r[0] == $usuario["id"]){ ?>
                                        <div class="resource-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-subtitle mb-2 text-muted">Archivo Adjunto</h6>
                                                <p class="card-text">Nombre del archivo: <a href="#"
                                                        onclick="cargarPdf2('<?php echo $r[1] ?>','<?php echo $r[0]?>')"><?php echo $r[1] ?></a>
                                                </p>
                                                <p class="card-text">
                                                    <i class="far fa-file-pdf fa-2x"></i> <!-- Icono de archivo PDF -->
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                        <?php }
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php if ($_SESSION["usuario"]["id"] == $clase["id_usuario_creador"]) { ?>
        <div class="content hidden" id="content3">
            <style>
                .list-group-item {
                    cursor: pointer;
                }

                .comment-box {
                    border: 1px solid #ddd;
                    padding: 15px;
                    background-color: #f9f9f9;
                }

                .comment-item {
                    border-bottom: 1px solid #ddd;
                    padding: 5px 0;
                }

                .comment-item:last-child {
                    border-bottom: none;
                }
            </style>
            <div class="container mt-5">
                <div class="row">
                    <!-- Lista de Alumnos -->
                    <div class="col-md-4">
                        <h4>Lista de Alumnos</h4>
                        <ul class="list-group">
                            <?php
                            $usados = array();
                            for ($i = 0; $i < count($general); $i++) {
                                if (!in_array($general[$i]["id"], $usados)) { ?>
                                    <li class="list-group-item" data-id="<?php echo $general[$i]["id"]; ?>"
                                        data-person="<?php echo $general[$i]["name"]; ?>">
                                        <?php echo $general[$i]["name"]; ?>
                                    </li>
                                    <?php
                                    $usados[] = $general[$i]["id"];
                                }
                            } ?>
                        </ul>
                    </div>

                    <!-- Caja de Comentarios -->
                    <div class="col-md-8">
                        <h4>Comentarios</h4>
                        <div class="comment-box" id="commentBox">
                            <div id="personName">Selecciona un alumno para ver los comentarios.</div>
                            <div id="commentsList" class="mt-3">
                                <!-- Comentarios aparecerán aquí -->
                            </div>
                            <textarea id="newComment" class="form-control mt-3" rows="3"
                                placeholder="Escribe un nuevo comentario..."></textarea>
                            <button id="addComment" class="btn btn-primary mt-2">Agregar Comentario</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                actual = 0;

                $('.list-group-item').on('click', function () {
                    let personName = $(this).data('person');
                    actual = $(this).data('id');
                    var comments = [];
                    $('#personName').text('Comentarios para ' + personName);
                    $('#commentsList').empty();
                    $.ajax({
                        url: 'clase_ver_tarea.php?id=<?php echo $_GET["id"] ?>&tid=<?php echo $_GET["tid"] ?>', // URL de la API
                        method: 'POST', // Método de la solicitud
                        data: {
                            id_priv: actual
                        },
                        success: function (data) {
                            comments = JSON.parse(data);
                            if (comments.length > 0) {
                                comments.forEach(comment => {
                                    opcion = "right"
                                    if (comment.bandera == 0) {
                                        opcion = "left"
                                    }
                                    $('#commentsList').append(`<div class="comment-item" style="text-align:` + opcion + `;" >${comment.mensaje}</div>`);
                                });
                            } else {
                                $('#commentsList').append('<div class="comment-item">No hay comentarios.</div>');
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error('Error en la solicitud: ' + textStatus, errorThrown);
                        }
                    });
                });

                $('#addComment').on('click', function () {
                    let personName = $('#personName').text().replace('Comentarios para ', '');
                    let newComment = $('#newComment').val();

                    if (personName && newComment && actual != 0) {
                        console.log("enviandoooo")
                        $.ajax({
                            type: 'POST',
                            url: 'clase_ver_tarea.php?id=<?php echo $_GET["id"]; ?>&tid=<?php echo $_GET["tid"]; ?>', // Cambia esto a la URL de tu script PHP
                            data: {
                                'nmensaje': newComment,
                                'id': actual
                            },
                            success: function (response) {
                                $('#commentsList').append(`<div class="comment-item">${newComment}</div>`);
                                $('#newComment').val('');
                            },
                            error: function (xhr, status, error) {
                                $('#response').html('<div class="alert alert-danger">Error: ' + error + '</div>');
                            }
                        });
                    }
                });
            </script>
        </div>
    <?php } ?>
</div>
<script>
    function cargarPdf(nom) {
        document.querySelector("iframe").src = "xd.php?tid=<?php echo $tarea["id"]."&" ?>&nom=" + nom;
        document.querySelector("iframe").style.display = "block";
        document.querySelector("#close-button").style.display = "block";
    }
    function cargarPdf2(nom,si) {
        document.querySelector("iframe").src = "zd.php?tid=<?php echo $tarea["id"]; ?>!"+si+"&nom=" + nom;
        console.log("zd.php?tid=<?php echo $tarea["id"]; ?>\&"+si+"&nom=" + nom);
        document.querySelector("iframe").style.display = "block";
        document.querySelector("#close-button").style.display = "block";
    }
    document.getElementById('close-button').addEventListener('click', function () {
        document.querySelector("iframe").style.display = 'none';
        this.style.display = 'none'; // Oculta el botón también
    });
</script>