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