<ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <?php if ($espacio): ?>
        <li><a href="espacios.php">Espacios</a></li>
        <li><a href="espacio.php?id=<?php echo $idEspacio; ?>">"<?php echo $espacio['nombre']; ?>"</a></li>

    <?php else: ?>
        <li><a href="clases.php">Clases</a></li>
    <?php endif; ?>
    <li><a href="clase.php?id=<?php echo $id_Clase; ?>">"<?php echo $result['nombre']; ?>"</a></li>
    <li><a class="active" href="clase.php?id=<?php echo $id_Clase; ?>">Tablero</a></li>

</ul>
<?php require_once "views/clase_navbar.php"; ?>
<!-- Main Container -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="container mt-5">
    <!-- Header -->
    <?php if ($fondo['estado'] == "activa") { ?>
        <div class="jumbotron" style="<?php if (preg_match('/\.(jpg|png)$/i', $fondo['fondo'])): ?>background-image: url('img/fondos/<?php echo $fondo['fondo']; ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;<?php else: ?>background-color: <?php echo htmlspecialchars($fondo['fondo']); ?>;<?php endif; ?>width: 100%; height: auto; position: relative;">
        <?php } else { ?>
            <style>
                .si {
                    background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.5) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.5) 50%, rgba(255, 255, 255, 0.5) 75%, transparent 75%, transparent);
                    background-size: 10px 10px;
                }
            </style>
            <div class="jumbotron si" style="<?php if (preg_match('/\.(jpg|png)$/i', $fondo['fondo'])): ?>background-image: url('img/fondos/<?php echo $fondo['fondo']; ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;<?php else: ?>background-color: <?php echo htmlspecialchars($fondo['fondo']); ?>;<?php endif; ?>width: 100%; height: auto; position: relative;">

            <?php } ?>
            <div style="position: absolute; top: 10px; right: 10px; z-index: 1;">
                <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#archivarClase"><i class="fa-solid fa-box-archive"></i></button>
                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#editPhoto"><i class="fa-solid fa-pen-to-square"></i></button>


                <?php foreach ($profesores as $profesor):
                    if ($profesor['id'] == $_SESSION['usuario']['id']):  ?>
                        <button class="btn btn-outline-danger" data-toggle="modal" data-target="#eliminarClase"><i class="fa-solid fa-trash"></i></button>

                <?php endif;
                endforeach; ?>
            </div>
            <!-- modal para el edit de banner -->
            <div class="modal fade" id="editPhoto" tabindex="-1" role="dialog" aria-labelledby="editPhotoLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editPhotoLabel">Editar foto o color</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" id="bgForm">
                                <!-- Navbar para seleccionar entre Fondo y Color -->
                                <ul class="nav nav-tabs mb-3" id="bgTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="background-tab" data-toggle="tab" href="#background" role="tab" aria-controls="background" aria-selected="true">Fondo</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="color-tab" data-toggle="tab" href="#color" role="tab" aria-controls="color" aria-selected="false">Color</a>
                                    </li>
                                </ul>

                                <!-- Contenido del Tab -->
                                <div class="tab-content" id="bgTabContent">
                                    <!-- Selección de Fondos -->
                                    <div class="tab-pane fade show active" id="background" role="tabpanel" aria-labelledby="background-tab">
                                        <div id="backgroundSelector">
                                            <select id="bgDropdown" name="bg"></select>
                                            <div id="bgPreview" style="margin-top: 10px; width: 100%; height: 200px; border: 1px solid #ccc;"></div>
                                        </div>
                                    </div>

                                    <!-- Selección de Colores -->
                                    <div class="tab-pane fade" id="color" role="tabpanel" aria-labelledby="color-tab">
                                        <div id="colorSelector">
                                            <input type="color" id="colorPicker" name="color" value="#ffffff">
                                            <div id="colorPreview" style="margin-top: 10px; width: 100%; height: 200px; border: 1px solid #ccc; background-color: #ffffff;"></div>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" name="sub" value="Guardar" class="btn btn-primary mt-3">
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- modal para Arcguvar clase -->
            <?php if ($fondo['estado'] == "activa") { ?>
                <div class="modal fade" id="archivarClase" tabindex="2" role="dialog" aria-labelledby="archivarClaseLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="archivarClaseLabel">¿Desea archivar esta clase?</h5>
                            </div>
                            <div class="modal-body">
                                <form method="POST">
                                    <input type="hidden" name="id_clase_archivar" value="<?php echo $_GET['id']; ?>">
                                    <button type="submit" class="btn btn-danger">Si, quiero archivar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="modal fade" id="archivarClase" tabindex="2" role="dialog" aria-labelledby="archivarClaseLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="archivarClaseLabel">¿Desea desarchivar esta clase?</h5>
                            </div>
                            <div class="modal-body">
                                <form method="POST">
                                    <input type="hidden" name="id_clase_desarchivar" value="<?php echo $_GET['id']; ?>">
                                    <button type="submit" class="btn btn-danger">Si, quiero desarchivar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>



            <!-- modal para eliminar clase -->
            <div class="modal fade" id="eliminarClase" tabindex="2" role="dialog" aria-labelledby="eliminarClaseLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="eliminarClaseLabel">¿Desea eliminar esta clase?</h5>
                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <input type="hidden" name="id_clase_eliminar" value="<?php echo $_GET['id']; ?>">
                                <button type="submit" class="btn btn-danger">Si, quiero eliminarla</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <h1 class="display-4"><strong><?php echo $result["nombre"]; ?></strong></h1>
            
            <?php foreach ($profesores as $profesor):
                    if ($profesor['id'] == $_SESSION['usuario']['id']):  ?>
                <p class="lead">Código de la clase: <?php echo $result["codigo"]; ?></p>

                <?php endif;
                endforeach; ?>
            <hr class="my-4">
            <h4>Profesores de la Clase</h4>
            <ul>
                <?php foreach ($profesores as $profesor): ?>
                    <li><?php echo $profesor['nombre'] . " " . htmlspecialchars($profesor['apellido']) ?></li>
                <?php endforeach; ?>
            </ul>
            </div>

            <!-- Horarios -->
            <div class="card mb-4">
                <div class="card-header">Horarios</div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <?php while ($horario = mysqli_fetch_assoc($horarios)) { ?>
                            <li><?php echo $horario["dia_semana"] . ": " . date('H:i', strtotime($horario["hora_inicio"])) . " - " . date('H:i', strtotime($horario["hora_fin"])); ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <!-- Anuncios Recientes -->
            <div class="card mb-4">
                <div class="card-header">Anuncios Recientes</div>
                <div class="card-body">
                    <h5 class="card-title">Nuevo Examen</h5>
                    <p class="card-text">El próximo lunes tendremos un examen sobre poesía del siglo XX. ¡Estudien bien!</p>
                    <p class="card-text"><small class="text-muted">Publicado el 25 de mayo, 2024</small></p>
                </div>
            </div>

            <!-- Actividades Recientes -->
            <div class="card mb-4">
                <div class="card-header">Actividades Recientes</div>
                <div class="card-body">
                    <h5 class="card-title">Tarea: Análisis de un poema</h5>
                    <p class="card-text">Fecha de entrega: 30 de mayo, 2024</p>
                    <a href="#" class="btn btn-primary">Ver Tarea</a>
                </div>
            </div>

            <!-- Material de Clase -->
            <div class="card mb-4">
                <div class="card-header">Material de Clase</div>
                <div class="card-body">
                    <h5 class="card-title">Lecturas</h5>
                    <p class="card-text">Pueden encontrar las lecturas del tema actual en el siguiente enlace.</p>
                    <a href="#" class="btn btn-primary">Ver Lecturas</a>
                </div>
            </div>

            <!-- Foro de Discusión -->
            <div class="card mb-4">
                <div class="card-header">Foro de Discusión</div>
                <div class="card-body">
                    <h5 class="card-title">Debate sobre la poesía del siglo XX</h5>
                    <p class="card-text">Participen en el foro para discutir sobre las obras estudiadas.</p>
                    <a href="#" class="btn btn-primary">Ir al Foro</a>
                </div>
            </div>

            <!-- Notas -->
            <div class="card mb-4">
                <div class="card-header">Notas</div>
                <div class="card-body">
                    <h5 class="card-title">Calificaciones Recientes</h5>
                    <p class="card-text">Consulta tus últimas calificaciones en el siguiente enlace.</p>
                    <a href="#" class="btn btn-primary">Ver Notas</a>
                </div>
            </div>
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const imagenes = [{
                        nombre: "Fondo 1",
                        archivo: "bg1.jpg"
                    },
                    {
                        nombre: "Fondo 2",
                        archivo: "bg2.jpg"
                    },
                    {
                        nombre: "Fondo 3",
                        archivo: "bg3.jpg"
                    },
                    {
                        nombre: "Fondo 4",
                        archivo: "bg4.jpg"
                    },
                    {
                        nombre: "Fondo 5",
                        archivo: "bg5.jpg"
                    },
                    {
                        nombre: "Fondo 6",
                        archivo: "bg6.jpg"
                    },
                    {
                        nombre: "Fondo 7",
                        archivo: "bg7.jpg"
                    },
                    {
                        nombre: "Fondo 8",
                        archivo: "bg8.jpg"
                    },
                    {
                        nombre: "Fondo 9",
                        archivo: "bg9.jpg"
                    },
                    {
                        nombre: "Fondo 10",
                        archivo: "bg10.jpg"
                    }
                ];

                const dropdown = document.getElementById('bgDropdown');
                const preview = document.getElementById('bgPreview');
                const bgOptionBackground = document.getElementById('optionBackground');
                const bgOptionColor = document.getElementById('optionColor');
                const backgroundSelector = document.getElementById('backgroundSelector');
                const colorSelector = document.getElementById('colorSelector');
                const colorPicker = document.getElementById('colorPicker');
                const colorPreview = document.getElementById('colorPreview');

                imagenes.forEach(imagen => {
                    const option = document.createElement('option');
                    option.value = imagen.archivo;
                    option.textContent = imagen.nombre;
                    dropdown.appendChild(option);
                });

                let imagenSeleccionada = '';

                dropdown.addEventListener('change', function() {
                    const archivoSeleccionado = this.value;
                    imagenSeleccionada = archivoSeleccionado;
                    preview.style.backgroundImage = `url('img/fondos/${archivoSeleccionado}')`;
                    preview.style.backgroundSize = 'cover';
                });

                dropdown.addEventListener('mouseover', function(event) {
                    const archivoSeleccionado = event.target.value;
                    if (archivoSeleccionado) {
                        preview.style.backgroundImage = `url('img/fondos/${archivoSeleccionado}')`;
                        preview.style.backgroundSize = 'cover';
                    }
                });

                dropdown.addEventListener('mouseout', function() {
                    if (imagenSeleccionada) {
                        preview.style.backgroundImage = `url('img/fondos/${imagenSeleccionada}')`;
                        preview.style.backgroundSize = 'cover';
                    } else {
                        preview.style.backgroundImage = '';
                    }
                });

                bgOptionBackground.addEventListener('change', function() {
                    backgroundSelector.style.display = 'block';
                    colorSelector.style.display = 'none';
                });

                bgOptionColor.addEventListener('change', function() {
                    backgroundSelector.style.display = 'none';
                    colorSelector.style.display = 'block';
                });

                colorPicker.addEventListener('input', function() {
                    const color = this.value;
                    colorPreview.style.backgroundColor = color;
                });
            });
        </script>