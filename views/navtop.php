<nav class="navbar navbar-expand-lg navbar-dark navbar-educolab">
    <a class="navbar-brand" href="clases.php"><img src="img/EduCollab_simple.png" width="50">EduCollab</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php if (isset($_SESSION["usuario"])) { ?>
                <li class="nav-item">
                    <a class="nav-link <?php if ($view == "clases") echo "active" ?>" href="clases.php"><i class="fa fa-th-large"></i> Clases</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($view == "espacios") echo "active" ?>" href="espacios.php"><i class="fa fa-th"></i> Espacios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($view == "tareas") echo "active" ?>" href="tareas.php"><i class="fas fa-tasks"></i> Tareas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($view == "calendario") echo "active" ?>" href="calendario.php"><i class="fa fa-calendar"></i> Calendario</a>
                </li>
            <?php } else { ?>
                <!---li class="nav-item active">
                    <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
                </li--->
            <?php } ?>
        </ul>
        <?php if (isset($_SESSION['usuario'])) { ?>
            <a href="miperfil.php"><img src="img/foto_perfil/<?php echo $_SESSION['usuario']['img']; ?>" style="border-radius:50%; width:3rem; height:3rem;  object-fit: cover; background-color:white;" class="profile"></a>
            <a href="logout.php" style="margin-left: 5px;"><button class="btn btn-light my-2 my-sm-0" type="button">Logout</button></a>
        <?php } else if (!isset($_SSESIOB['usuario'])) { ?>
            <a href="login.php" style="color:white"><button class="btn btn-outline-light my-2 my-sm-0 mr-2" type="button">Iniciar sesión</button></a>
            <a href="register.php"><button class="btn btn-light my-2 my-sm-0" type="button">Registrate</button></a>
        <?php } ?>
    </div>
</nav>