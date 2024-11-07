<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css
">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js
">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js
">
<link rel="stylesheet" href="css/miperfil.css">


<style>
    .option-form {
        width: 8rem;
        display: inline-block;
    }

    .lbl {
        display: block;
        text-align: center;
        filter: opacity(0);
    }

    .void {
        width: 0px;
        height: 8rem;
        object-fit: cover;
        filter: opacity(0);
    }

    .Height {
        display: inline-block;
        width: 0px;
    }

    .option-photo {
        margin: 0, 0, 0, 0;
        width: 8rem;
        height: 8rem;
        object-fit: cover;
        transition: filter 0.2s, margin-bottom 0.2s ease-in-out;
    }

    .option-form:hover .option-photo {
        border: 2px solid #333;
        filter: brightness(40%);
        background-color: rgba(33, 33, 33, 0);
        margin-bottom: 10px;
    }

    .profile {
        transition: 0.3s filter ease-in-out;
    }

    .profile:hover {
        border: 0px solid #333;
        background-color: rgba(33, 33, 33, 0);
        filter: brightness(40%);
    }

    .cent_tex {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>

<ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li><a class="active" href="miperfil.php">Mi Perfil</a></li>
</ul>

<div class="container mt-5">
    <!-- Jumbotron del Perfil -->
    <div class="jumbotron" style="background-color: #32418B; color: white; border-radius: 10px; padding: 2rem;">
        <div class="row align-items-center">
            <!-- Foto de Perfil -->
            <div class="col-md-4 text-center" >
                <img href="#" data-toggle="modal" data-target="#editPhoto" class="profile"
                    src="img/foto_perfil/<?php echo $_SESSION['usuario']['img']; ?>" height="300" width="300"
                    style="object-fit: cover; background-color: white; border-radius: 10px; border: 2px solid black;">
            </div>
            <!-- Información del Usuario -->
            <div class="col-md-8">
                <h1 class="display-4 title"><strong><?php echo $_SESSION['usuario']['nombre'] . " " . $_SESSION['usuario']['apellido']; ?></strong></h1>
                <span class="idd"><?php echo "(" . $_SESSION['usuario']['name'] . ")" ?></span>
                <p class="lead"><b>Correo Electrónico:</b> <?php echo $_SESSION['usuario']['email']; ?></p>
                <p class="lead"><b>Edad:</b> <?php echo $_SESSION['usuario']['edad']; ?></p>
                <span class="idd"><i class="fa fa-github"></i> <?php echo " " . $_SESSION['usuario']['github']; ?></span>
            </div>
        </div>
    </div>
</div>
<div style="width: 100%;" align="center">
<img src="./img/fondos/zi.jpg" alt="">
<?php require_once "views/modal_perfil.php"; ?>
</div>
