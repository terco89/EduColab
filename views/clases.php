<link rel="stylesheet" href="./css/clases.css">
<div class="container mt-4">
    <form method="POST" action="crear_clase.php">
        <h1>Mis Clases</h1>
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
                        <form method="POST" action="crear_clase.php">
    <div class="form-group" >
        <h4>Nombre de la clase</h4>
        <input type="text" class="form-control" name="nombre" placeholder="Nombre de la clase" required>
    </div>
    <div class="form-group">
        <h4>Días y Horarios</h4>
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
        </div>
        <button type="button" onclick="addSchedule()">Agregar Horario</button>
    </div>
    <input type="submit" class="btn btn-success" value="Subir" style="background-color:#10b5c1f7;border-color:#10b5c1f7;">
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
                    </div>
                </div>
            </div>
    </form>
    <br>
    <div class="container">
    <div class="row">
    <?php if (count($clases) == 0) { ?>
        <h2 class="text-center">Aún no tienes clases</h2>
    <?php } else {
        foreach ($clases as $clase) { ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo $clase["nombre"] ?></h3>
                        <h6 class="card-subtitle mb-2 text-muted">
                            Profesor: <?php echo ($clase['id_usuario_creador'] != $_SESSION['usuario']['id']) ? $clase["nombre"] : "tú"; ?>
                        </h6>
                        <hr>
                        <p class="card-text">Horarios:</p>
                        <ul class="list-unstyled">
                            <?php foreach ($clase['horarios'] as $horario) {
                                $hora_inicio = date('H:i', strtotime($horario["hora_inicio"]));
                                $hora_fin = date('H:i', strtotime($horario["hora_fin"]));
                            ?>
                                <li><?php echo $horario["dia_semana"] . " de " . $hora_inicio . " a " . $hora_fin; ?></li>
                            <?php } ?>
                        </ul>
                        <a href="clase.php?id=<?php echo $clase["id"] ?>" class="btn btn-primary" style="background-color:#10b5c1f7;border-color:#10b5c1f7;">Ir a la clase</a>
                    </div>
                </div>
            </div>
    <?php }
    } ?>
</div>
</div>
</div>