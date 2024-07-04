<style>
  /* Estilos personalizados pueden ir aquí */
  body {
    background-color: #f8f9fa;
  }

  .container {
    margin-top: 50px;
  }
</style>
<div class="container">
  <!--form method="POST" action="crear_clase.php"--->
  <h1>Espacios
    <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#submitModal">Crear un espacio</a>
    <div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="submitModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="submitModalLabel">Crear un espacio</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <h4>Nombre del espacio</h4>
                <input type="text" class="form-control" id="taskTitle" name="nombre" placeholder="Nombre del espacio" required>
              </div>
              <div class="form-group">
                <h4>Curso y divisiòn</h4>
                <input type="text" class="form-control" id="taskTitle" name="curso y division" placeholder="curso y division">
              </div>
              <div class="form-group">
                <h4>Clases a agrupar</h4>
                <select class="form-select" aria-label="Default select example" style="font-size:large">
                  <option selected>Selecciona las clases</option>
                  <option value="1">mate</option>
                  <option value="2">lengua</option>
                  <option value="3">ingles</option>
                </select>
              </div>
              <input type="submit" class="btn btn-success" value="subir" style="background-color:#10b5c1f7;border-color:#10b5c1f7;">
            </form>
          </div>
        </div>
      </div>
    </div>
    </form>
  </h1>
  <!---a href="espacio_unirse.php" class="btn btn-secondary">Unirse a un espacio</a>
    <a href="espacio_crear.php" class="btn btn-secondary">Crear un espacio</a-->


  <div class="row mt-4">
    <div class="col-md-4">
      <div class="card mb-4">
        <div class="card-body">
          <h5 class="card-title">6°10</h5>
          <p class="card-text">Confederación Suiza</p>
          <a href="espacio.php" class="btn btn-primary" style="background-color:#10b5c1f7;border-color:#10b5c1f7;">Ver Clases</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card mb-4">
        <div class="card-body">
          <h5 class="card-title">Taller de primero</h5>
          <p class="card-text">Confederación Suiza</p>
          <a href="#" class="btn btn-primary" style="background-color:#10b5c1f7;border-color:#10b5c1f7;">Ver Clases</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card mb-4">
        <div class="card-body">
          <h5 class="card-title">Espacio personalizado</h5>
          <p class="card-text">Tu</p>
          <a href="#" class="btn btn-primary" style="background-color:#10b5c1f7;border-color:#10b5c1f7;">Ver Clases</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Enlace a Bootstrap JS y dependenci