<?php session_start() ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="index.php">EduCollab</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="clases.php">Clases</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tareas.php">Tareas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="calendario.php">Calendario</a>
            </li>
        </ul>
        <?php if (isset($_SESSION['usuario'])) { ?>
        <?php if ($_SESSION['usuario']['rol']=='profesor'){?>
        <form method="POST">
        <a href="#" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#submitModal">Crear una clase</a>
        <div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="submitModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="submitModalLabel">Crear una clase</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="taskTitle">Nombre de la clase</label>
                                <input type="text" class="form-control" id="taskTitle" name="nombre" placeholder="Nombre de la clase">
                            </div>
                            <div class="form-group">
                                <label for="taskTitle">Seccion</label>
                                <input type="text" class="form-control" id="taskTitle" name="seccion" placeholder="Seccion">
                            </div>
                            <div class="form-group">
                                <label for="taskTitle">Asignatura</label>
                                <input type="text" class="form-control" id="taskTitle" name="asignatura" placeholder="Asignatura">
                            </div>
                            <input type="submit" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <?php } ?>
        <form class="form-inline my-2 my-lg-0">
            <img src="img/<?php echo $_SESSION['usuario']['img']; ?>" style="border-radius:50%; width:3rem; height:3rem;  object-fit: cover;">
                <button class="btn btn-light my-2 my-sm-0" type="button"><a href="logout.php">Logout</a></button>
            <?php } else if (!isset($_SSESIOB['usuario'])) { ?>
                <a href="login.php" style="color:white"><button class="btn btn-outline-light my-2 my-sm-0 mr-2" type="button">Iniciar sesión</button></a>
                <a href="register.php"><button class="btn btn-light my-2 my-sm-0" type="button">Registrate</button></a>
            <?php } ?>
        </form>
    </div>
</nav>