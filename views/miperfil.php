<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css
">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js
">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js
">

<link rel="stylesheet" href="css/miperfil.css">
<br>
<div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
    <div class="card p-4" style="cursor:default;">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="cont" style="cursor:pointer;">
                <div><img href="#" data-toggle="modal" data-target="#editPhoto" class="profile" src="img/alumno.jpg" height="100" width="100" /></div>
                <div class="cent_tex" href="#" data-toggle="modal" data-target="#editPhoto"><i class="fa fa-pencil-square-o"></i></div>
            </div>
            <span class="name mt-3"><?php echo $_SESSION['usuario']['name']; ?></span>
            <span class="idd"><?php echo $_SESSION['usuario']['email']; ?></span>
            <div class="d-flex flex-row justify-content-center align-items-center gap-2"> <span class="idd1">Oxc4c16a645_b21a</span> <span><i class="fa fa-copy"></i></span> </div>
            <div class="d-flex flex-row justify-content-center align-items-center mt-3"> <span class="number">5 <span class="follow">Clases</span></span> </div>
            <div class=" d-flex mt-2"> <button class="btn1 btn-dark" style="border-radius: 10px 20px;">Editar Perfil</button> </div>
            <div class="text mt-3"> <span>Eleanor Pena is a creator of minimalistic x bold graphics and digital
                    artwork.<br><br> Artist/ Creative Director by Day #NFT minting@ with FND night. </span> </div>
            <div class="gap-3 mt-3 icons d-flex flex-row justify-content-center align-items-center"> <span><i
                        class="fa fa-twitter"></i></span> <span><i class="fa fa-facebook-f"></i></span> <span><i
                        class="fa fa-instagram"></i></span> <span><i class="fa fa-linkedin"></i></span><i class="fa fa-whatsapp"></i> </div>
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
                            <form>
                                <div class="form-group">
                                    <label for="taskTitle">Seleccionar imagen</label>
                                    <input type="file" class="form-control" id="taskTitle" name="nombre" placeholder="Nombre de la clase">
                                </div>
                                <input type="submit" value="subir">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>