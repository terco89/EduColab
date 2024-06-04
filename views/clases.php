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
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Clase de Matemáticas</h3>
                    <h6 class="card-subtitle mb-2 text-muted">Profesor: Gabriel Valera</h6>
                    <hr>
                    <p class="card-text">Esta clase cubrirá temas avanzados de álgebra y cálculo.</p>
                    <p class="card-text">Fecha y hora: Martes y Jueves, 10:00 AM - 12:00 PM</p>
                    <a href="clase2.php" class="btn btn-primary">Ir a la clase</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Clase de Literatura</h3>
                    <h6 class="card-subtitle mb-2 text-muted">Profesor: David Martínez</h6>
                    <hr>
                    <p class="card-text">Analisis de las obras literarias más destacadas de la historia.</p>
                    <p class="card-text">Fecha y hora: Martes y Jueves, 11:00 AM - 1:00 PM</p>
                    <a href="clase.php" class="btn btn-primary">Ir a la clase</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Clase de Química</h3>
                    <h6 class="card-subtitle mb-2 text-muted">Profesor: Ana García</h6>
                    <hr>
                    <p class="card-text">Explora los principios fundamentales de la química y las reacciones químicas.</p>
                    <p class="card-text">Fecha y hora: Lunes y Miércoles, 9:00 AM - 11:00 AM</p>
                    <a href="#" class="btn btn-primary disabled">Ir a la clase</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Clase de Geografía</h3>
                    <h6 class="card-subtitle mb-2 text-muted">Profesor: Laura Sánchez</h6>
                    <hr>
                    <p class="card-text">Explora los diferentes aspectos de la geografía mundial, desde la cartografía hasta el clima y la demografía.</p>
                    <p class="card-text">Fecha y hora: Miércoles y Viernes, 10:00 AM - 12:00 PM</p>
                    <a href="#" class="btn btn-primary disabled">Ir a la clase</a>
                </div>
            </div>
        </div>
        <!-- Agregar más tarjetas según sea necesario -->
    </div>
</div>