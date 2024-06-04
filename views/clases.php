<link rel="stylesheet" href="./css/clases.css">
<div class="container mt-4">
    <form method="POST" action="crear_clase.php">
        <h1>Mis Clases
            <a href="clase_unirse.php" class="btn btn-secondary">Unirse a una clase</a>
            <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#submitModal">Crear una clase</a>
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
                                    <h4>Nombre de la clase</h4>
                                    <input type="text" class="form-control" id="taskTitle" name="nombre" placeholder="Nombre de la clase">
                                </div>
                                <div class="form-group">
                                    <h4>Seccion</h4>
                                    <input type="text" class="form-control" id="taskTitle" name="seccion" placeholder="Seccion">
                                </div>
                                <div class="form-group">
                                    <h4>Asignatura</h4>
                                    <input type="text" class="form-control" id="taskTitle" name="asignatura" placeholder="Asignatura">
                                </div>
                                <div class="form-group">
                                    <h4>Descripcion</h4>
                                    <input type="text" class="form-control" id="taskTitle" name="descripcion" placeholder="Descripcion">
                                </div>
                                <input type="submit" class="btn btn-success" value="subir">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </form>
    </h1>

    <br>
    <div class="row">
    <?php 
    if(count($clases) == 0){
        ?>
        <h2 class="text-center">Aún no tienes clases</h2>
    <?php }else{
    for($i =0; $i < count($clases); $i++){
    ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title"><?php echo $clases[$i]["nombre"] ?></h3>
                    <h6 class="card-subtitle mb-2 text-muted">Profesor: X</h6>
                    <hr>
                    <p class="card-text"><?php echo $clases[$i]["descripcion"]; ?></p>
                    <p class="card-text">Fecha y hora: <?php echo $clases[$i]["fecha_horario"]; ?></p>
                    <a href="clase2.php" class="btn btn-primary">Ir a la clase</a>
                </div>
            </div>
        </div>
        
        <!-- Agregar más tarjetas según sea necesario -->
    </div>
    <?php } }?>
</div>