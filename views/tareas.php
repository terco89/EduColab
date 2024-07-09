<div class="container">
  <br>
  <h1>Tareas</h1>
  <br>
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-header bg-danger text-light">
          <h5 class="card-title">Tareas Pendientes</h5>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <?php for($i = 0; $i < count($tareas); $i++){ 
              if(intval($tareas[$i]["est"]) == 1){?>
            <li class="list-group-item tarea"><?php echo $tareas[$i]["n"] ?></li>
            <?php } } ?>
          </ul>
        </div>
      </div>
    </div>

    <div class="col-md-4 ">
      <div class="card">
        <div class="card-header bg-success text-light">
          <h5 class="card-title">Tareas Completadas</h5>
        </div>
        <div class="card-body">
          <ul class="list-group">
          <?php for($i = 0; $i < count($tareas); $i++){ 
              if(intval($tareas[$i]["est"]) == 2){?>
            <li class="list-group-item tarea"><?php echo $tareas[$i]["n"] ?></li>
            <?php } } ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header bg-info  text-light">
          <h5 class="card-title">Tareas Corregidas</h5>
        </div>
        <div class="card-body">
          <ul class="list-group">
          <?php for($i = 0; $i < count($tareas); $i++){ 
              if(intval($tareas[$i]["est"]) == 3){?>
            <li class="list-group-item tarea"><?php echo $tareas[$i]["n"] ?></li>
            <?php } } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .tarea {
      transition: background-color 0.3s ease;
    }
    .tarea:hover {
      background-color: rgba(0, 0, 0, 0.1); /* Cambiar el último valor para ajustar el nivel de oscurecimiento */
    }
</style>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
