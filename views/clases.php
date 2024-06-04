<link rel="stylesheet" href="./css/clases.css">
<div class="container mt-4">
    <h1>Mis Clases
    <a href="clase_unirse.php" class="btn btn-secondary">Unirse a una clase</a>
    <a href="clase2.php" class="btn btn-secondary">Crear una clase</a>
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