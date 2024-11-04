<ul class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li><a href="clases.php">Clases</a></li>
  <li><a class="active" href="clase_unirse.php">Unirse a Clase</a></li>
</ul>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card card-unirse">
        <div class="card-body">
          <h5 class="card-title text-center">Unirse a Clase</h5>
          <form method="POST" class="">
            <div class="form-group">
              <b>
                <label for="codigoClase">Código de la Clase:</label>
              </b>
              <p>Pídele a tu profesor el código de clase e introdúcelo aquí.</p>
              <input type="text" class="form-control" id="codigoClase" name="codigoClase" placeholder="Introduce el código de la clase">
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-unirse">Unirse</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>