<ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <?php if ($espacio): ?>
        <li><a href="espacios.php">Espacios</a></li>
        <li><a href="espacio.php?id=<?php echo $idEspacio; ?>">"<?php echo $espacio['nombre']; ?>"</a></li>

    <?php else: ?>
        <li><a href="clases.php">Clases</a></li>
    <?php endif; ?>
    <li><a  href="clase.php?id=<?php echo $result['id']; ?>">"<?php echo $result['nombre']; ?>""</a></li>
    <li><a class="active"href="clase_foro.php?id=<?php echo $result['id']; ?>">Foro</a></li>

</ul>
<?php require_once "views/clase_navbar.php"; ?>

    <!-- Main Container -->
    <div class="container mt-5">
        <!-- Header -->
        <div class="jumbotron">
            <h1 class="display-4">Foro de Discusión</h1>
            <p class="lead">Participa en los debates y haz preguntas sobre los temas de clase.</p>
        </div>

        <!-- Nuevo Tema de Discusión -->
        <div class="card mb-4">
            <div class="card-header">
                Crear Nuevo Tema de Discusión
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label for="topicTitle">Título del Tema</label>
                        <input type="text" class="form-control" id="topicTitle" name="tema" placeholder="Ingresa el título del tema" require>
                    </div>
                    <div class="form-group">
                        <label for="topicContent">Contenido del Tema</label>
                        <textarea class="form-control" id="topicContent" rows="3" name="contenido" placeholder="Escribe el contenido del tema" require></textarea>
                    </div>
                    <input type="text" name="id" hidden value="<?php echo $_GET["id"]; ?>">
                    <button type="submit" class="btn btn-primary">Crear Tema</button>
                </form>
            </div>
        </div>

        <!-- Lista de Temas de Discusión -->
        <div class="card mb-4">
            <div class="card-header">
                Temas de Discusión
            </div>
            <div class="card-body">
             <!-- Tema 1 -->
              <?php
              if(isset($discusiones) && count($discusiones) > 0){
              for($i = 0; $i < count($discusiones); $i++){ ?>
                <div class="media mb-3">
                    <img src="https://via.placeholder.com/64" class="mr-3" alt="User Avatar">
                    <div class="media-body">
                        <h5 class="mt-0"><?php echo $discusiones[$i]["tema"]; ?></h5>
                        <p><?php echo substr($discusiones[$i]["contenido"], 0, 30) . "..."; ?></p>
                        <p><small class="text-muted">Publicado por <?php echo $discusiones[$i]["name"]; ?> el <?php $date = new DateTime($discusiones[$i]["fecha_creacion"]); echo $date->format('d-m-Y'); ?></small></p>
                        <a href="clase_discusion.php?id=<?php echo $_GET["id"]; ?>&did=<?php echo $discusiones[$i]["id"] ?>" class="btn btn-secondary btn-sm">Ver Tema</a>
                    </div>
                </div>
                <?php }}else{ ?>
                    <h2>Se el primero en abrir un debate</h2>
                    <?php } ?>
                <!-- Más temas pueden ser añadidos aquí -->
            </div>
        </div>
    </div>