<?php session_start()?>
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
            <form class="form-inline my-2 my-lg-0">
            <?php if (isset($_SESSION['usuario'])) {?><img src="img/<?php echo $_SESSION['usuario']['img']; ?>"style="border-radius:50%; width:3rem; height:3rem;  object-fit: cover;" >
                <button class="btn btn-light my-2 my-sm-0" type="button"><a href="logout.php">Logout</a></button>
            <?php } else if (!isset($_SSESIOB['usuario'])){?>
            <a href="login.php" style="color:white"><button class="btn btn-outline-light my-2 my-sm-0 mr-2" type="button">Iniciar sesión</button></a>
            <a href="register.php"><button class="btn btn-light my-2 my-sm-0" type="button">Registrate</button></a>
            <?php } ?>
        </form>
        </div>
    </nav>