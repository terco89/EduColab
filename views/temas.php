<ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <?php if ($espacio): ?>
        <li><a href="espacios.php">Espacios</a></li>
        <li><a href="espacio.php?id=<?php echo $idEspacio; ?>">"<?php echo $espacio['nombre']; ?>"</a></li>

    <?php else: ?>
        <li><a href="clases.php">Clases</a></li>
    <?php endif; ?>
    <li><a href="clase.php?id=<?php echo $result["id"] ?>">"<?php echo $result['nombre']; ?>"</a></li>
    <li><a class="active" href="temas.php?id=<?php echo $result["id"] ?>">Temas</a></li>

</ul>
<?php require_once "views/clase_navbar.php"; ?>
<link rel="stylesheet" href="./css/clases.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
    <div class="jumbotron">
        <h1 class="display-4">Temas</h1>
        <p class="lead">Aquí encontrarás todos tus temas asignados.</p>
        
        <?php foreach ($profesores as $profesor):
        
            if ($profesor['id'] == $_SESSION['usuario']['id']):  ?>

                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#submitModal">Crear tema</a>
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
                                    <button type="submit" class="btn btn-secondary">Crear Tema</button>
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
        <?php endif;
        endforeach; ?>
    </div> <?php if (count($temas) == 0) { ?>
        <br><br><br><br><br>
                <div style="margin-top:-150px;" class="no-clases">
                    <img src="./img/books.png" alt="">
                    <h5>Aún no tienes temas</h5>
                </div>
                <?php } else { ?>
    <!-- Material de Clase -->
    <?php for ($i = 0; $i < count($temas); $i++) { ?>
        <div class="card mb-4">
            <div class="card-header">
                Material de Clase
            </div>
            <div class="card-body">
                <div class="media mb-3">
                    <img src="img/EduCollab.jpg" style="width: 4rem; border-radius:50%;" class="mr-3" alt="User Avatar">
                    <div class="media-body">
                        <h5 class="truncate" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 350px;"><?php echo $temas[$i]["nombre"] ?></h5>
                        <p><?php echo $temas[$i]["fecha_alta"]; ?></p>
                        <a href="ver_temas.php?id=<?php echo $_GET["id"] ?>&tid=<?php echo $temas[$i]["id"] ?>" class="btn btn-secondary btn-sm">Ver tema</a> <!--&nbsp;&nbsp;<a class="btn btn-danger btn-sm">Eliminar tema</a----->
                    </div>
                </div>
            </div>
        </div>
    <?php } }?>