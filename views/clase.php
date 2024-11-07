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
<div class="container mt-5">
    <?php if ($fondo['estado'] == "activa") { ?>
        <div class="jumbotron" style="<?php if (preg_match('/\.(jpg|png)$/i', $fondo['fondo'])): ?>background-image: url('img/fondos/<?php echo $fondo['fondo']; ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;<?php else: ?>background-color: <?php echo $fondo['fondo']; ?>;<?php endif; ?>width: 100%; height: auto; position: relative;">
            <div class="overlay"></div>
        <?php } else { ?>
            <style>
                .si {
                    background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.5) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.5) 50%, rgba(255, 255, 255, 0.5) 75%, transparent 75%, transparent);
                    background-size: 10px 10px;
                }
            </style>
            <div class="jumbotron si" style="<?php if (preg_match('/\.(jpg|png)$/i', $fondo['fondo'])): ?>background-image: url('img/fondos/<?php echo $fondo['fondo']; ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;<?php else: ?>background-color: <?php echo $fondo['fondo']; ?>;<?php endif; ?>width: 100%; height: auto; position: relative;">
            <?php } ?>
            <div style="position: absolute; top: 10px; right: 10px; z-index: 1;">
                <button class="btn btn-pink" data-toggle="modal" data-target="#archivarClase"><i class="fa-solid fa-box-archive"></i></button>
                <button class="btn btn-lila" data-toggle="modal" data-target="#editPhoto"><i class="fa-solid fa-pen-to-square"></i></button>
                <?php foreach ($profesores as $profesor):
                    if ($profesor['id'] == $_SESSION['usuario']['id']):  ?>
                        <button class="btn btn-skyblue" data-toggle="modal" data-target="#eliminarClase"><i class="fa-solid fa-trash"></i></button>
                <?php endif;
                endforeach; ?>
            </div>
            <h1 class="display-4 title"><strong><?php echo $result["nombre"]; ?></strong></h1>
            <?php foreach ($profesores as $profesor):
                if ($profesor['id'] == $_SESSION['usuario']['id']):  ?>
                    <p class="lead"><b>Código de la clase:</b> <?php echo $result["codigo"]; ?></p>
            <?php endif;
            endforeach; ?>
            <hr>
            <p class="lead"><b>Profesores de la Clase:</b></p>
            <?php foreach ($profesores as $profesor): ?>
                <a class="profe"><?php echo $profesor['nombre'] . " " . htmlspecialchars($profesor['apellido']) ?></a>
            <?php endforeach; ?>
            </div>
            <div class="card mb-4 cards-clase">
                <div class="card-header">Horarios</div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <?php while ($horario = mysqli_fetch_assoc($horarios)) { ?>
                            <li><?php echo $horario["dia_semana"] . ": " . date('H:i', strtotime($horario["hora_inicio"])) . " - " . date('H:i', strtotime($horario["hora_fin"])); ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="card mb-4 cards-clase">
                <div class="card-header">Anuncios Recientes</div>
                <div class="card-body">
                    <h5 class="card-title">Nuevo Examen</h5>
                    <p class="card-text">El próximo lunes tendremos un examen sobre poesía del siglo XX. ¡Estudien bien!</p>
                    <p class="card-text"><small class="text-muted">Publicado el 25 de mayo, 2024</small></p>
                </div>
            </div>
            <div class="card mb-4 cards-clase">
                <div class="card-header">Actividades Recientes</div>
                <div class="card-body">
                    <h5 class="card-title">Tarea: Análisis de un poema</h5>
                    <p class="card-text">Fecha de entrega: 30 de mayo, 2024</p>
                    <a href="#" class="btn btn-light">Ver Tarea</a>
                </div>
            </div>
            <div class="card mb-4 cards-clase">
                <div class="card-header">Material de Clase</div>
                <div class="card-body">
                    <h5 class="card-title">Lecturas</h5>
                    <p class="card-text">Pueden encontrar las lecturas del tema actual en el siguiente enlace.</p>
                    <a href="#" class="btn btn-light">Ver Lecturas</a>
                </div>
            </div>
            <div class="card mb-4 cards-clase">
                <div class="card-header">Foro de Discusión</div>
                <div class="card-body">
                    <h5 class="card-title">Debate sobre la poesía del siglo XX</h5>
                    <p class="card-text">Participen en el foro para discutir sobre las obras estudiadas.</p>
                    <a href="#" class="btn btn-light">Ir al Foro</a>
                </div>
                        </div>
        </div>
</div>
<?php require_once "views/modal_clase.php"; ?>
<script src="js/clase.js"></script>