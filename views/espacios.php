<link rel="stylesheet" href="./css/clases.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li><a class="active" href="espacios.php">Espacios</a></li>
</ul>

<div  class="container">

    <h1  >Espacios</h1><br>
    <button   type="button" class="btn btn-light" data-toggle="modal" data-target="#submitModal">Crear un espacio</button>
    
    <!-- Modal -->
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
                    <form action="espacios.php" method="POST">
                        <div class="form-group">
                            <label for="nombreEspacio">Nombre del espacio</label>
                            <input type="text" class="form-control" id="nombreEspacio" name="nombre" placeholder="Nombre del espacio" required>
                        </div>
                        <div class="form-group">
                            <label for="cursoDivision">Curso y división</label>
                            <input type="text" class="form-control" id="cursoDivision" name="curso_division" placeholder="Curso y división" required>
                        </div>
                        <div class="form-group">
                            <label for="clases">Clases a agrupar</label>
                            <div id="clases">
                                <?php
                                if ($resultClases->num_rows <= 0) { ?>
                                    <p>No hay espacios disponibles.</p>
                                    <?php
                                } else {
                                    while ($rowClase = $resultClases->fetch_assoc()): ?>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="clase<?php echo htmlspecialchars($rowClase['id']); ?>" name="clases[]" value="<?php echo htmlspecialchars($rowClase['id']); ?>">
                                            <label class="form-check-label" for="clase<?php echo htmlspecialchars($rowClase['id']); ?>">
                                                <?php echo htmlspecialchars($rowClase['nombre']); ?>
                                            </label>
                                        </div>
                                <?php endwhile;
                                } ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Subir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Listado de espacios -->
    <div class="row mt-4">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <a href="espacio.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="card-link">
                        <div class="card-body" style="background-image: linear-gradient(to right, #32418B, #A09AE5, #BA8CE9, #D598DA); border-radius: 20px; height:150px">
                            <h5 class="card-title" style="color:white"><?php echo htmlspecialchars($row['nombre']); ?></h5>
                            <p class="card-text" style="color:white"><?php echo htmlspecialchars($row['curso_division']); ?></p>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else: ?> <div class="no-clases">
                    <img src="./img/books.png" alt="">
                    <h5>Aún no tienes espacios</h5>
                </div>
        <?php endif; ?>
    </div>
</div>

<!-- Scripts de Bootstrap y jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>