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
</style>
<br>
<div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
    <div class="card p-4" style="cursor:default;">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="cont" style="cursor:pointer;">
                <div><img href="#" data-toggle="modal" data-target="#editPhoto" class="profile" src="img/foto_perfil/<?php echo $_SESSION['usuario']['img']; ?>" height="100" width="100" style="object-fit: cover;" /></div>
                <div class="cent_tex" href="#" data-toggle="modal" data-target="#editPhoto"><i class="fa fa-pencil-square-o"></i></div>
            </div>
            <span class="name mt-3"><?php echo $_SESSION['usuario']['name']; ?></span>
            <span class="idd"><?php echo $_SESSION['usuario']['email']; ?></span>
            <div class="d-flex flex-row justify-content-center align-items-center gap-2"> <span class="idd1">Oxc4c16a645_b21a</span> <span><i class="fa fa-copy"></i></span> </div>
            <div class="d-flex flex-row justify-content-center align-items-center mt-3"> <span class="number">5 <span class="follow">Clases</span></span> </div>
            <div class=" d-flex mt-2"> <button class="btn1 btn-dark" style="border-radius: 10px 20px;">Editar Perfil</button> </div>
            <div class="text mt-3"> <span>Eleanor Pena is a creator of minimalistic x bold graphics and digital
                    artwork.<br><br> Artist/ Creative Director by Day #NFT minting@ with FND night. </span> </div>
            <div class="gap-3 mt-3 icons d-flex flex-row justify-content-center align-items-center"> <span><i class="fa fa-twitter"></i></span> <span><i class="fa fa-facebook-f"></i></span> <span><i class="fa fa-instagram"></i></span> <span><i class="fa fa-linkedin"></i></span><i class="fa fa-whatsapp"></i> </div>
            <div class=" px-2 rounded mt-4 date "> <span class="join">Joined May,2021</span> </div>






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
                            <div style="border-bottom: 1px solid black;border-top: 1px solid black;">
                                <div>
                                    <div class="Height">
                                        <form method="post" class="option-form" style="user-select:none">
                                            <br>
                                            <input type="image" src="img/foto-perfil/blank.png" class="void" disabled>
                                            <label class="lbl">Useless</label>
                                        </form>
                                    </div>
                                    <div style="display: inline-block;">
                                        <form method="post" class="option-form">
                                            <input type="hidden" name="alumno" value="alumno.jpg" class="Height">
                                            <input title="Set this image as profile photo" type="image" id="alumno" class="option-photo" name="alumno" value="alumno.jpg" alt="Login" src="img/foto_perfil/alumno.jpg">
                                            <label style="display: block; text-align: center;">Alumno 1</label>
                                        </form>
                                    </div>
                                    <div style="display: inline-block;">
                                        <form method="post" class="option-form">
                                            <input type="hidden" name="alumno2" value="alumno2.png" class="Height">
                                            <input title="Set this image as profile photo" type="image" id="alumno2" class="option-photo" name="alumno2" value="alumno2.png" alt="Login" src="img/foto_perfil/alumno2.png">
                                            <label style="display: block; text-align: center;">Alumno 2</label>
                                        </form>
                                    </div>
                                    <div>
                                        <div class="Height">
                                            <form method="post" class="option-form" style="user-select:none">
                                                <br>
                                                <input type="image" src="img/foto_perfil/blank.png" class="void" disabled>
                                                <label class="lbl">Useless</label>
                                            </form>
                                        </div>
                                        <div style="display: inline-block;">
                                            <form method="post" class="option-form">
                                                <input type="hidden" name="alumno3" value="alumno3.png" class="Height">
                                                <input title="Set this image as profile photo" type="image" id="alumno3" class="option-photo" name="alumno3" value="alumno3.png" alt="Login" src="img/foto_perfil/alumno3.png">
                                                <label style="display: block; text-align: center;">Alumno 3</label>
                                            </form>
                                        </div>
                                        <form method="post" class="option-form">
                                            <input type="hidden" name="eve" value="eve.jpg" class="Height">
                                            <input title="Set this image as profile photo" type="image" id="eve" class="option-photo" name="eve" value="eve.jpg" alt="Login" src="img/foto_perfil/eve.jpg">
                                            <label style="display: block; text-align: center;">Alumno 4</label>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>