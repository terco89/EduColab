<?php require_once "views/clase_navbar.php"; ?>

<!-- Main Container -->
<div class="container mt-5">
    <!-- Header -->
    <div class="jumbotron">
        <h1 class="display-4">Tareas</h1>
        <p class="lead">Aquí encontrarás todas las tareas asignadas y podrás enviar tus trabajos.</p>
        <?php if ($_SESSION['usuario']['id'] == $result["id_usuario_creador"]) { ?>
            <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#submitModal">Crear tarea</a>
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
                                    <input type="file" id="archivo" name="archivo" accept=".pdf, .doc, .docx, .txt" required>
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
                                    $sql = "select id_usuario from clase_usuario where id_usuario != ".$_SESSION["usuario"]["id"]." and id_clase = " . $result["id"];
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
                                        $nombre = mysqli_insert_id($link);
                                        mkdir("img/tareas/" . $nombre . "");
                                        $ruta = "img/tareas/" . $nombre . "/" . $archivo_nombre;
                                        if (move_uploaded_file($archivo_temporal, $ruta)) {
                                            echo "El archivo se ha subido correctamente.";
                                        } else {
                                            echo "Error al subir el archivo.";
                                        }
                                    }
                                    echo '<script>window.location.href = "clase_ver_tarea.php?id=' . $result["id"] . '&tid=' . mysqli_insert_id($link) . '";</script>';
                                    exit();
                                }
                                ?>
                                <!-- Controlador -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Horarios de la Clase -->
    <div class="card mb-4">
        <div class="card-header">
            Horarios de la Clase
        </div>
        <div class="card-body">
            <ul class="list-unstyled">
                <?php foreach ($horarios as $horario) {
                    $hora_inicio = date('H:i', strtotime($horario["hora_inicio"]));
                    $hora_fin = date('H:i', strtotime($horario["hora_fin"]));
                ?>
                    <li><?php echo $horario["dia_semana"] . " de " . $hora_inicio . " a " . $hora_fin; ?></li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <!-- Lista de Tareas -->
    <div class="card mb-4">
        <div class="card-header">
            Lista
        </div>
        <div class="card-body">
            <?php for ($i = 0; $i < count($tareas); $i++) { ?>
                <div class="media mb-3">
                    <img src="https://via.placeholder.com/64" class="mr-3" alt="User Avatar">
                    <div class="media-body">
                        <h5 class="truncate" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 350px;"><?php echo $tareas[$i]["nombre"] ?></h5>
                        <p><?php echo $tareas[$i]["descripcion"]; ?></p>
                        <p>Fecha de entrega: <?php echo date('j \d\e F, Y', strtotime($tareas[$i]["fecha_entrega"])); ?></p>
                        <a href="clase_ver_tarea.php?id=<?php echo $_GET["id"] ?>&tid=<?php echo $tareas[$i]["id"] ?>" class="btn btn-secondary btn-sm">Ver Tarea</a>
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