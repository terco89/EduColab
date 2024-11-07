<link rel="stylesheet" href="./css/clases.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li><a class="active" href="clases.php">Clases</a></li>
</ul>
<div class="container mt-4">
    <form method="POST" action="crear_clase.php">
        <div class="clases-botones">
            <a href="clase_unirse.php" class="btn btn-light">Unirse a una clase</a>
            <a href="clase_archivada.php" class="btn btn-light">Clase Archivada</a>
            <a href="#" class="btn btn-light" data-toggle="modal" data-target="#submitModal">Crear una clase</a>
        </div>
        <div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="submitModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="submitModalLabel" style="font-weight: 700;font-size: 1.5em;color: #32418b;">Crear una clase</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="crear_clase.php">
                            <div class="form-group">
                                <b>
                                    <label style="color: #32418b;">Nombre:</label>
                                </b> <input type="text" class="form-control" name="nombre" placeholder="Nombre de la clase" required>
                            </div>
                            <div class="form-group">
                                <b>
                                    <label style="color: #32418b;">Horarios:</label>
                                </b>
                                <div id="schedule-container">
                                    <div class="schedule-item">
                                        <label>Día:</label>
                                        <select name="dias_semana[]">
                                            <option value="Lunes">Lunes</option>
                                            <option value="Martes">Martes</option>
                                            <option value="Miércoles">Miércoles</option>
                                            <option value="Jueves">Jueves</option>
                                            <option value="Viernes">Viernes</option>
                                            <option value="Sábado">Sábado</option>
                                            <option value="Domingo">Domingo</option>
                                        </select>
                                        <label>Desde:</label>
                                        <input type="time" name="hora_inicio[]" required>
                                        <label>Hasta:</label>
                                        <input type="time" name="hora_fin[]" required>
                                    </div>
                                </div><br>
                                <button type="button" class="btn btn-primary" onclick="addSchedule()">Agregar Horario</button>
                            </div>
                        </form>

                        <script>
                            function addSchedule() {
                                const container = document.getElementById('schedule-container');
                                const newScheduleItem = document.createElement('div');
                                newScheduleItem.className = 'schedule-item';
                                newScheduleItem.innerHTML = `
        <label>Día:</label>
        <select name="dias_semana[]">
            <option value="Lunes">Lunes</option>
            <option value="Martes">Martes</option>
            <option value="Miércoles">Miércoles</option>
            <option value="Jueves">Jueves</option>
            <option value="Viernes">Viernes</option>
            <option value="Sábado">Sábado</option>
            <option value="Domingo">Domingo</option>
        </select>
        <label>Desde:</label>
        <input type="time" name="hora_inicio[]" required>
        <label>Hasta:</label>
        <input type="time" name="hora_fin[]" required>
    `;
                                container.appendChild(newScheduleItem);
                            }
                        </script>

                    </div>
                    <div class="modal-footer"> <input type="submit" class="btn btn-secondary"style="background-color: #32418B;" value="Crear">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br>
    <div class="container">
        <div class="row">
            <?php if (count($clases) == 0) { ?>
                <div class="no-clases">
                    <img src="./img/books.png" alt="">
                    <h5>Aún no tienes clases</h5>
                </div>
                <?php } else {
                foreach ($clases as $clase) {  ?>

                    <a href="clase.php?id=<?php echo $clase['id']; ?>" class="card-link">
                        <div class="card card-clase">
                            <div class="card-body card-banner" style="<?php if (preg_match('/\.(jpg|png)$/i', $clase['fondo'])): ?>background-image: url('img/fondos/<?php echo $clase['fondo']; ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;<?php else: ?>background-color: <?php echo htmlspecialchars($clase['fondo']); ?>;<?php endif; ?>;">
                                <div class="overlay"></div>
                                <h3 class="card-title"><?php echo $clase["nombre"] ?></h3>
                                <h6 class="card-subtitle ">
                                    Profesor: <?php echo ($clase['id_usuario_creador'] != $_SESSION['usuario']['id']) ? $clase["nombre_profesor"] . " " . $clase["apellido_profesor"] : "tú"; ?>
                                </h6>
                            </div>
                            <div class="card-horarios">
                                <?php
                                $horarios = $clase['horarios'];
                                $numHorarios = count($horarios);
                                $maxHorarios = 2;
                                $mostrarMas = $numHorarios > $maxHorarios;
                                for ($i = 0; $i < ($mostrarMas ? $maxHorarios : $numHorarios); $i++) {
                                    $hora_inicio = date('H:i', strtotime($horarios[$i]["hora_inicio"]));
                                    $hora_fin = date('H:i', strtotime($horarios[$i]["hora_fin"]));
                                    echo "<p style=color:#6c757d;>" . $horarios[$i]["dia_semana"] . " de " . $hora_inicio . " a " . $hora_fin . "</p>";
                                }
                                if ($mostrarMas) {
                                    echo "<p style=color:#6c757d;>...</p>";
                                }
                                ?>
                            </div>
                        </div>
                    </a>


            <?php }
            } ?>
        </div>
    </div>
</div>
<style>
    .btn-primary {
        background-image: linear-gradient(to right, #32418B, #A09AE5, #BA8CE9, #D598DA);
        border: none;
        transition: .5s;
    }

    .btn-primary:hover {
        transform: scale(1.1);
        background-image: linear-gradient(to right, #32418B, #A09AE5, #BA8CE9, #D598DA);
    }
</style>