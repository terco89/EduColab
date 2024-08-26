<ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <?php if ($espacio): ?>
        <li><a href="espacios.php">Espacios</a></li>
        <li><a href="espacio.php?id=<?php echo $idEspacio; ?>">"<?php echo $espacio['nombre']; ?>"</a></li>

    <?php else: ?>
        <li><a href="clases.php">Clases</a></li>
    <?php endif; ?>
    <li><a  href="clase.php?id=<?php echo $result['id']; ?>"><?php echo $result['nombre']; ?></a></li>
    <li><a class="active"href="clase_tareas.php?id=<?php echo $result['id'];?>">Tareas</a></li>

</ul>
<?php require_once "views/clase_navbar.php"; ?>
<style>
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
<!-- Main Container -->
<div class="container mt-5">
    <!-- Header -->
    <div class="jumbotron">
        <h1 class="display-4">Tareas</h1>
        <p class="lead">Aquí encontrarás todas las tareas asignadas y podrás enviar tus trabajos.</p>
        <?php if ($_SESSION['usuario']['id'] == $result["id_usuario_creador"]) { ?>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#submitModal">Crear tarea</a>
            <div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="submitModalLabel" aria-hidden="true">
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
                                    <h4>Titulo</h4>
                                    <input type="text" class="form-control" name="titulo" maxlength="50" required>
                                </div>
                                <div class="form-group">
                                    <label for="instruccion">Instrucciones</label>
                                    <textarea class="form-control" name="instruccion" rows="4" maxlength="250" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="archivo">Selecciona un archivo:</label>
                                    <input type="file" id="archivo" name="archivo" accept=".pdf, .doc, .docx, .txt" onchange="mostrarVistaPrevia()">
                                    <div id="vista_previa" class="preview-container" onclick="cambiarArchivo()">
                                        <img id="imagen_previa" class="preview" src="#" alt="Vista previa del archivo seleccionado">
                                        <div id="info_archivo" class="file-info" style="pointer-events: none;">Nombre del archivo: </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fecha_limite">Fecha límite</label>
                                    <input type="datetime-local" class="form-control" name="fecha_limite" required>
                                </div>
                                <button type="submit" class="btn btn-secondary">Crear Tarea</button>
                                <!-- Controlador aca porque sino no funciona-->
                                <?php if (isset($_POST['titulo'])) {
                                    $sql = "INSERT INTO tareas (id, nombre, descripcion, fecha_subida, fecha_entrega, clase_id) 
                                            VALUES (null, '" . $_POST['titulo'] . "', '" . $_POST['instruccion'] . "', NOW(), '" . $_POST['fecha_limite'] . "', '" . $result["id"] . "')";
                                    $query = mysqli_query($link, $sql);
                                    if (!$query) {
                                        echo "Fallo consulta: " . mysqli_error($link);
                                        exit();
                                    }
                                    $tid = mysqli_insert_id($link);
                                    $sql = "select id_usuario from clase_usuario where id_usuario != " . $_SESSION["usuario"]["id"] . " and id_clase = " . $result["id"];
                                    $query = mysqli_query($link, $sql);
                                    $ids = array();
                                    if (mysqli_num_rows($query) > 0) {
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            $ids[] = $row;
                                        }
                                    }
                                    for ($i = 0; $i < count($ids); $i++) {
                                        $sql = "INSERT INTO tarea_usuario(tarea_id,usuario_id,estado) VALUES($tid," . $ids[$i]["id_usuario"] . ",1)";
                                        $query = mysqli_query($link, $sql);
                                        if (!$query) {
                                            echo "Fallo consulta: " . mysqli_error($link);
                                            exit();
                                        }
                                    }

                                    if (isset($_SESSION['usuario']) && isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
                                        $archivo_nombre = $_FILES['archivo']['name'];
                                        $archivo_temporal = $_FILES['archivo']['tmp_name'];
                                        $nombre = $tid;
                                        mkdir("img/tareas/" . $nombre . "");
                                        $ruta = "img/tareas/" . $nombre . "/" . $archivo_nombre;
                                        if (move_uploaded_file($archivo_temporal, $ruta)) {
                                            echo "El archivo se ha subido correctamente.";
                                        } else {
                                            echo "Error al subir el archivo.";
                                        }
                                    }
                                    echo '<script>window.location.href = "clase_ver_tarea.php?id=' . $result["id"] . '&tid=' . $tid . '";</script>';
                                    exit();
                                }
                                ?>
                                <!-- Controlador -->
                            </form>
                            <script>
                                function mostrarVistaPrevia() {
                                    var archivo = document.getElementById('archivo').files[0];
                                    var vistaPrevContainer = document.getElementById('vista_previa');
                                    var imagen_previa = document.getElementById('imagen_previa');
                                    var info_archivo = document.getElementById('info_archivo');

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

                                function cambiarArchivo() {
                                    var inputArchivo = document.getElementById('archivo');
                                    inputArchivo.value = ''; // Limpiar el valor del input
                                    document.getElementById('vista_previa').style.display = 'none'; // Ocultar la vista previa
                                    inputArchivo.style.display = 'block'; // Mostrar el input de archivo
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Lista de Tareas -->
    <?php for ($i = 0; $i < count($tareas); $i++) { ?>

    <div class="card mb-4">
        <div class="card-header">
            Tarea <!-- si se puede hacer que aparesca el numero de la tarea subi rj: tarea 1; tarea 2 y achi ....-->
        </div>
        <div class="card-body">
                <div class="media mb-3">
                    <img src="img/EduCollab.jpg" style="width: 4rem; border-radius:50%;" class="mr-3" alt="User Avatar">
                    <div class="media-body">
                        <h5 class="truncate" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 350px;"><?php echo $tareas[$i]["nombre"] ?></h5>
                        <p>Fecha de entrega: <?php echo date('j \d\e F, Y', strtotime($tareas[$i]["fecha_entrega"])); ?></p>
                        <a href="clase_ver_tarea.php?id=<?php echo $_GET["id"] ?>&tid=<?php echo $tareas[$i]["id"] ?>" class="btn btn-secondary btn-sm">Ver Tarea</a>
                    </div>
                </div>
        </div>
    </div>
    <?php } ?>

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