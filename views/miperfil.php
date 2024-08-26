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
<div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
    <div class="card p-4" style="cursor:default;">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="cont" style="cursor:pointer;">
                <div><img href="#" data-toggle="modal" data-target="#editPhoto" class="profile"
                        src="img/foto_perfil/<?php echo $_SESSION['usuario']['img']; ?>" height="150" width="150"
                        style="object-fit: cover; background-color:White; border-radius: 10px 10px 10px 10px; border: 2px solid black " />
                </div>
                <div class="cent_tex" href="#" data-toggle="modal" data-target="#editPhoto"><i
                        class="fa fa-pencil-square-o"></i></div>
            </div>
            <br>
            <span class="name mt-3"
                style="font-size:25px;"><?php echo $_SESSION['usuario']['nombre'] . " " . $_SESSION['usuario']['apellido']; ?></span>
            <!-- <div class="d-flex flex-row justify-content-center align-items-center gap-2"> <span
                        class="idd1">Oxc4c16a645_b21a</span> <span><i class="fa fa-copy"></i></span> </div> -->
            <span class="idd"><?php echo "(" . $_SESSION['usuario']['name'] . ")" ?></span>
            <br><span class="idd"><?php echo "Email: " . $_SESSION['usuario']['email']; ?></span>
            <span class="idd"><?php echo "Edad: " . $_SESSION['usuario']['edad'] ?></span>
            <span class="idd"> <i class="fa fa-github"></i><?php echo " ".$_SESSION['usuario']['github'] ?></span>
        </div>
    </div>
</div>
<div class="modal fade" id="editPhoto" tabindex="-1" role="dialog" aria-labelledby="editPhotoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php if ($_SESSION['usuario']['name'] == "reichsacht") { ?>
                    <h5 class="modal-title" id="editPhotoLabel"><a href="#" data-toggle="modal" data-target="#sec"
                            style="text-decoration: none; color: black;cursor: unset">Editar foto</a></h5><?php } else { ?>
                    <h5 class="modal-title" id="editPhotoLabel">Editar foto</h5>
                <?php } ?>
                <div class="modal fade" id="sec" tabindex="-1" role="dialog" aria-labelledby="editPhotoLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="modal-body">
                                    <div style="display: inline-block;">
                                        <div class="Height">
                                            <form method="post" class="option-form" style="user-select:none">
                                                <br>
                                                <input type="image" src="img/foto-perfil/blank.png" class="void"
                                                    disabled>
                                                <label class="lbl">Useless</label>
                                            </form>
                                        </div>
                                        <form method="post" class="option-form">
                                            <input type="hidden" name="sec" value="v-chan.png" class="Height">
                                            <input title="Set this image as profile photo" type="image" id="v-chan"
                                                class="option-photo" name="image" value="v-chan.png" alt="Login"
                                                src="img/foto_perfil/v-chan.png">
                                            <label style="display: block; text-align: center;">V-chan</label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="border-bottom: 1px solid black;border-top: 1px solid black;">
                    <?php
                    $images = [
                        ["none", "none.jpg", "Ninguno"],
                        ["alumno", "alumno.jpg", "Alumno"],
                        ["profesor", "profesor.jpg", "Profesor"],
                    ];
                    foreach ($images as $image) {
                        echo '<div style="display: inline-block;">
                                <div class="Height">
                                    <form method="post" class="option-form" style="user-select:none">
                                        <br>
                                        <input type="image" src="img/foto-perfil/blank.png" class="void" disabled>
                                        <label class="lbl">Useless</label>
                                    </form>
                                </div>
                                <form method="post" class="option-form">
                                    <input type="hidden" name="' . $image[0] . '" value="' . $image[1] . '" class="Height">
                                    <input title="Set this image as profile photo" type="image" id="' . $image[0] . '" class="option-photo" name="image" value="' . $image[1] . '" alt="Login" src="img/foto_perfil/' . $image[1] . '">
                                    <label style="display: block; text-align: center;">' . $image[2] . '</label>
                                </form>
                              </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>