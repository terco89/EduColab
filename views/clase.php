<?php require_once "views/clase_navbar.php"; ?>
<!-- Main Container -->
<div class="container mt-5">
    <!-- Header -->
    <div class="jumbotron" style="background-image:url(img/fondos/<?php echo $fondo['fondo'] ?>);">
        <button href="#" style="margin-left:950px; margin-top: 0px;" class="btn btn-primary" data-toggle="modal" data-target="#editPhoto">Config</button>

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
                            <select id="bgDropdown" name="bg">
                            </select>
                            <div id="bgPreview" style="margin-top: 10px; width: 100%; height: 200px; border: 1px solid #ccc;"></div>
                            <input type="submit" name="sub" value="Guardar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <h1 class="display-4"><?php echo $result["nombre"]; ?></h1>
        <?php if ($_SESSION['usuario']['id'] == $result["id_usuario_creador"]) { ?>
            <p class="lead"> Codigo de la clase: <?php echo $result["codigo"]; ?></p>
        <?php } ?>
        <hr class="my-4">
        <p>Profesor: <?php echo $result["name"]; ?></p>
    </div>

    <!-- Horarios -->
    <div class="card mb-4">
        <div class="card-header">
            Horarios
        </div>
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
        <div class="card-header">
            Anuncios Recientes

        </div>
        <div class="card-body">
            <h5 class="card-title">Nuevo Examen</h5>
            <p class="card-text">El próximo lunes tendremos un examen sobre poesía del siglo XX. ¡Estudien bien!</p>
            <p class="card-text"><small class="text-muted">Publicado el 25 de mayo, 2024</small></p>
        </div>
    </div>

    <!-- Actividades Recientes -->
    <div class="card mb-4">
        <div class="card-header">
            Actividades Recientes
        </div>
        <div class="card-body">
            <h5 class="card-title">Tarea: Análisis de un poema</h5>
            <p class="card-text">Fecha de entrega: 30 de mayo, 2024</p>
            <a href="#" class="btn btn-primary">Ver Tarea</a>
        </div>
    </div>

    <!-- Material de Clase -->
    <div class="card mb-4">
        <div class="card-header">
            Material de Clase
        </div>
        <div class="card-body">
            <h5 class="card-title">Lecturas</h5>
            <p class="card-text">Pueden encontrar las lecturas del tema actual en el siguiente enlace.</p>
            <a href="#" class="btn btn-primary">Ver Lecturas</a>
        </div>
    </div>

    <!-- Foro de Discusión -->
    <div class="card mb-4">
        <div class="card-header">
            Foro de Discusión
        </div>
        <div class="card-body">
            <h5 class="card-title">Debate sobre la poesía del siglo XX</h5>
            <p class="card-text">Participen en el foro para discutir sobre las obras estudiadas.</p>
            <a href="#" class="btn btn-primary">Ir al Foro</a>
        </div>
    </div>

    <!-- Notas -->
    <div class="card mb-4">
        <div class="card-header">
            Notas
        </div>
        <div class="card-body">
            <h5 class="card-title">Calificaciones Recientes</h5>
            <p class="card-text">Consulta tus últimas calificaciones en el siguiente enlace.</p>
            <a href="#" class="btn btn-primary">Ver Notas</a>
        </div>
    </div>
</div>
<div class="jumbotron" style="background-image:url(img/fondos/<?php echo $fondo['fondo'] ?>);">

<div><a href="#" data-toggle="modal" data-target="#editPhoto">Config</a></div>
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
                <form method="post">
                    <input type="text" name="bg" placeholder="bgX X=1~10">
                    <input type="submit" name="sub" value="Guardar">
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const imagenes = [
        { nombre: "Fondo 1", archivo: "bg1.jpg" },
        { nombre: "Fondo 2", archivo: "bg2.jpg" },
        { nombre: "Fondo 3", archivo: "bg3.jpg" },
        { nombre: "Fondo 4", archivo: "bg4.jpg" },
        { nombre: "Fondo 5", archivo: "bg5.jpg" },
        { nombre: "Fondo 6", archivo: "bg6.jpg" },
        { nombre: "Fondo 7", archivo: "bg7.jpg" },
        { nombre: "Fondo 8", archivo: "bg8.jpg" },
        { nombre: "Fondo 9", archivo: "bg9.jpg" },
        { nombre: "Fondo 10", archivo: "bg10.jpg" },
    ];
    const dropdown = document.getElementById('bgDropdown');
    const preview = document.getElementById('bgPreview');
    
    imagenes.forEach((imagen) => {
        const option = document.createElement('option');
        option.value = imagen.archivo;
        option.textContent = imagen.nombre;
        dropdown.appendChild(option);
    });
    
    dropdown.addEventListener('change', function() {
        const archivoSeleccionado = this.value;
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
        preview.style.backgroundImage = '';
    });
});

</script>