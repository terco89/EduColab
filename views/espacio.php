<style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        hr {
            background-color: rgb(14, 129, 133);
            border-width: 3px;
        }
        h3 {
            color: rgb(14, 129, 133);
        }
        .card-title {
            text-overflow: ellipsis;
        }
    </style>
</head>
<body>
    <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="espacios.php">Espacios</a></li>
        <li><a class="active" href="espacio.php?id=<?php echo htmlspecialchars($idEspacio); ?>"><?php echo htmlspecialchars($espacio['nombre']); ?></a></li>
    </ul>
    <div class="container">
        <h2 class="text-center">Espacio: <?php echo htmlspecialchars($espacio['nombre']); ?></h2>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Información del Espacio</h5>
                <p class="card-text">Este espacio está dedicado al curso de <?php echo htmlspecialchars($espacio['curso_division']); ?>. Aquí encontrarás todas las aulas de tu división.</p>
            </div>
        </div>
        <h3 class="mt-5" style="color:black;">Clases en este Espacio</h3>
        <div class="container">
            <div class="row">
                <?php 
                while ($clase = $resultClases->fetch_assoc()) {
                    // Obtener el fondo para la clase actual
                    $fondo = $fondos[$clase['id']] ?? null;

                    $dias_semana = explode(',', $clase['dia_semana']);
                    $horas_inicio = explode(',', $clase['hora_inicio']);
                    $horas_fin = explode(',', $clase['hora_fin']);
                ?>
                    <div class="col-md-4 mb-4">
                        <a href="clase.php?id=<?php echo htmlspecialchars($clase['id']); ?>&espacio=<?php echo htmlspecialchars($idEspacio); ?>" class="card-link">
                            <div class="card" style="height: 200px;">
                                <div class="card-body card-banner" style="<?php if ($fondo && preg_match('/\.(jpg|png)$/i', $fondo)): ?>background-image: url('img/fondos/<?php echo htmlspecialchars($fondo); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;<?php else: ?>background-color: <?php echo htmlspecialchars($fondo ?? '#ffffff'); ?>;<?php endif; ?>;">
                                    <h3 class="card-title"><?php echo htmlspecialchars($clase["nombre"]); ?></h3>
                                    <h6 class="card-subtitle mb-2 text-muted">Profesor: <?php echo htmlspecialchars($clase["nombre_profesor"]); ?></h6>
                                    <hr>
                                    <ul>
                                    <?php
                                    $maxHorarios = 2;
                                    for ($i = 0; $i < min($maxHorarios, count($dias_semana)); $i++) {
                                        echo "<li style='color:#6c757d;'>{$dias_semana[$i]} de " . date('H:i', strtotime($horas_inicio[$i])) . " a " . date('H:i', strtotime($horas_fin[$i])) . "</li>";
                                    }
                                    if (count($dias_semana) > $maxHorarios) {
                                        echo "<li style='color:#6c757d;'>...</li>";
                                    }
                                    ?>
                                    </ul>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>