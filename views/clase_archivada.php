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
            <div class="no-clases">

            <img src="./img/books.png" alt="">

            <h5 class="text-center">Aún no tienes clases archivadas</h5></div>
            <?php } else {
            foreach ($clases as $clase) { ?>
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