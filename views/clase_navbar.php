<nav class="navbar navbar-expand-lg navbar-light bg-light" >
        <a class="navbar-brand" href="clase.php?id=<?php echo $_GET['id']?>"><?php echo $result["nombre"]; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="clase.php?id=<?php echo $_GET['id']?>">Tablero</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="temas.php?id=<?php echo $_GET['id']?>">Temas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="clase_tareas.php?id=<?php echo $_GET['id']?>">Tareas</a>
                </li>
                <li class="nav-item">
                    <a hidden class="nav-link" href="clase_material.php?id=<?php echo $_GET['id']?>">Material de Clase</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="clase_foro.php?id=<?php echo $_GET['id']?>">Foro de Discusión</a>
                </li>
                <li class="nav-item">
                    <a hidden class="nav-link" href="clase_notas.php?id=<?php echo $_GET['id']?>">Notas</a>
                </li>
            </ul>
        </div>
    </nav>