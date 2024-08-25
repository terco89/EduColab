<?php require_once "views/clase_navbar.php"; ?>
<!-- Main Container -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<<div class="container mt-5">
    <!-- Header -->
    <div class="jumbotron" style="background-image: url('img/fondos/<?php echo $fondo['fondo']; ?>'); background-size: cover; background-position: center; background-repeat: no-repeat; width: 100%; height: auto; position: relative;">
        <div style="position: absolute; top: 10px; right: 10px; z-index: 1;">
            <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#archivarClase"><i class="fa-solid fa-box-archive"></i></button>
            <?php if($_SESSION["usuario"]['id']==$result['id_usuario_creador']){?><button class="btn btn-outline-danger" data-toggle="modal" data-target="#eliminarClase"><i class="fa-solid fa-trash"></i></button><?php }?>
            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#editPhoto"><i class="fa-solid fa-pen-to-square"></i></button>
        </div>
        <!-- modal para el edit de banner -->
        <div class="modal fade" id="editPhoto" tabindex="-1" role="dialog" aria-labelledby="editPhotoLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPhotoLabel">Editar foto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="bgForm">
                            <select id="bgDropdown" name="bg"></select>
                            <div id="bgPreview" style="margin-top: 10px; width: 100%; height: 200px; border: 1px solid #ccc;"></div>
                            <input type="submit" name="sub" value="Guardar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal para Eliminar clase -->
        <div class="modal fade" id="eliminarClase" tabindex="1" role="dialog" aria-labelledby="eliminarClaseLabel" aria-hidden="true">
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


        <!-- modal para eliminar clase -->
        <div class="modal fade" id="archivarClase" tabindex="2" role="dialog" aria-labelledby="editPhotoLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPhotoLabel">Editar foto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                </div>
            </div>
        </div>

        <h1 class="display-4"><strong><?php echo $result["nombre"]; ?></strong></h1>
        <?php if ($_SESSION['usuario']['id'] == $result["id_usuario_creador"]) { ?>
            <p class="lead">Código de la clase: <?php echo $result["codigo"]; ?></p>
        <?php } ?>
        <hr class="my-4">
        <p>Profesor: <?php echo $result["profe_apellido"]." ". $result["profe_nombre"]; ?></p>
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
                },
            ];
            const dropdown = document.getElementById('bgDropdown');
            const preview = document.getElementById('bgPreview');

            imagenes.forEach((imagen) => {
                const option = document.createElement('option');
                option.value = imagen.archivo;
                option.textContent = imagen.nombre;
                dropdown.appendChild(option);
            });

            // Guardar la imagen seleccionada
            let imagenSeleccionada = '';

            dropdown.addEventListener('change', function() {
                const archivoSeleccionado = this.value;
                imagenSeleccionada = archivoSeleccionado; // Actualizar la imagen seleccionada
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

            // Eliminar el evento 'mouseout'
            dropdown.addEventListener('mouseout', function() {
                if (imagenSeleccionada) {
                    preview.style.backgroundImage = `url('img/fondos/${imagenSeleccionada}')`;
                    preview.style.backgroundSize = 'cover';
                } else {
                    preview.style.backgroundImage = '';
                }
            });
        });
    </script>