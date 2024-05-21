<div class="container">
  <br>
  <h1>Tareas</h1>
  <br>
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header bg-danger text-light">
          <h5 class="card-title">Tareas Pendientes</h5>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item tarea">Tarea 1</li>
            <li class="list-group-item tarea">Tarea 2</li>
            <li class="list-group-item tarea">Tarea 3</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header bg-warning text-light">
          <h5 class="card-title">Tareas En Progreso</h5>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item tarea">Tarea 4</li>
            <li class="list-group-item tarea">Tarea 5</li>
            <li class="list-group-item tarea">Tarea 6</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-6 mt-4">
      <div class="card">
        <div class="card-header bg-success text-light">
          <h5 class="card-title">Tareas Completadas</h5>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item tarea">Tarea 4</li>
            <li class="list-group-item tarea">Tarea 5</li>
            <li class="list-group-item tarea">Tarea 6</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-6 mt-4">
      <div class="card">
        <div class="card-header bg-info  text-light">
          <h5 class="card-title">Tareas Corregidas</h5>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item tarea">Tarea 4</li>
            <li class="list-group-item tarea">Tarea 5</li>
            <li class="list-group-item tarea">Tarea 6</li>
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
