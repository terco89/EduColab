<link rel="stylesheet" href="./css/clases.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li><a href="clases.php">Clases</a></li>
    <li><a class="active" href="clase_archivada.php">Archivadas</a></li>

</ul>
<div class="container mt-4">
    <h1>Clases Archivadas</h1>

</div>
<br>
<div class="container">
    <div class="row">
        <?php if (count($clases) == 0) { ?>
            <h2 class="text-center">Aún no tienes clases</h2>
            <?php } else {
            foreach ($clases as $clase) { ?>
                <div class="col-md-4 mb-4">
                    <a href="clase.php?id=<?php echo $clase['id']; ?>" class="card-link">
                        <div class="card" style="height: 200px;">
                            <style>
                                .si {
                                    background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.5) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.5) 50%, rgba(255, 255, 255, 0.5) 75%, transparent 75%, transparent);
                                    background-size: 10px 10px;
                                }
                            </style>
                            <div class="card-body card-banner si" style="<?php if (preg_match('/\.(jpg|png)$/i', $clase['fondo'])): ?>background-image: url('img/fondos/<?php echo $clase['fondo']; ?>'); background-size: cover; background-position: center;  opacity: 0.5;
 background-repeat: no-repeat;<?php else: ?>background-color: <?php echo htmlspecialchars($clase['fondo']); ?>;<?php endif; ?>;">

                                <h3 class="card-title"><?php echo $clase["nombre"] ?></h3>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    Profesor: <?php echo ($clase['id_usuario_creador'] != $_SESSION['usuario']['id']) ? $clase["nombre_profesor"] . " " . $clase["apellido_profesor"] : "tú"; ?>
                                </h6>
                                <hr>
                                <?php
                                $horarios = $clase['horarios'];
                                $numHorarios = count($horarios);
                                $maxHorarios = 2;
                                $mostrarMas = $numHorarios > $maxHorarios;
                                for ($i = 0; $i < ($mostrarMas ? $maxHorarios : $numHorarios); $i++) {
                                    $hora_inicio = date('H:i', strtotime($horarios[$i]["hora_inicio"]));
                                    $hora_fin = date('H:i', strtotime($horarios[$i]["hora_fin"]));
                                    echo "<li style=color:#6c757d;>" . $horarios[$i]["dia_semana"] . " de " . $hora_inicio . " a " . $hora_fin . "</li>";
                                }
                                if ($mostrarMas) {
                                    echo "<li style=color:#6c757d;>...</li>";
                                }
                                ?>
                            </div>
                        </div>
                    </a>
                </div>


        <?php }
        } ?>
    </div>
</div>
</div>