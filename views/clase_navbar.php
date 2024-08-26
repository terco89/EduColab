<nav class="navbar navbar-expand-lg navbar-light bg-light" >
        <a class="navbar-brand" href="clase.php?id=<?php echo $_GET['id']?>"><?php echo $result["nombre"]; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="clase.php?id=<?php echo $_GET['id']?>&espacio=<?php echo $idEspacio; ?>">Tablero</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="temas.php?id=<?php echo $_GET['id']?>&espacio=<?php echo $idEspacio; ?>">Temas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="clase_tareas.php?id=<?php echo $_GET['id']?>&espacio=<?php echo $idEspacio; ?>">Tareas</a>
                </li>
                <li class="nav-item">
                    <a hidden class="nav-link" href="clase_material.php?id=<?php echo $_GET['id']?>&espacio=<?php echo $idEspacio; ?>">Material de Clase</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="clase_foro.php?id=<?php echo $_GET['id']?>&espacio=<?php echo $idEspacio; ?>">Foro de Discusión</a>
                </li>
                <li class="nav-item">
                    <a hidden class="nav-link" href="clase_notas.php?id=<?php echo $_GET['id']?>"&espacio=<?php echo $idEspacio; ?>>Notas</a>
                </li>
            </ul>
        </div>
    </nav>