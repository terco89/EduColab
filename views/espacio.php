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
    <link rel="stylesheet" href="espacio.css">
<body>
    <div class="container">
        <h2 class="text-center">Espacio: <?php echo htmlspecialchars($espacio['nombre']); ?></h2>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Información del Espacio</h5>
                <p class="card-text">Este espacio está dedicado al curso de <?php echo htmlspecialchars($espacio['curso_division']); ?>. Aquí encontrarás todas las aulas de tu división.</p>
            </div>
        </div>
        <h3 class="mt-5" style="color:black;">Clases en este Espacio</h3>
        <div class="row mt-4">
            <?php while ($rowClase = $resultClases->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo htmlspecialchars($rowClase['nombre']); ?></h3>
                            <hr>
                            <p class="card-text">Día de la semana: <?php echo htmlspecialchars($rowClase['dia_semana']); ?></p>
                            <p class="card-text">Horario: <?php echo htmlspecialchars($rowClase['hora_inicio']); ?> - <?php echo htmlspecialchars($rowClase['hora_fin']); ?></p>
                            <a href="clase.php?id=<?php echo htmlspecialchars($rowClase['id']); ?>" class="btn btn-primary" style="background-color:#10b5c1f7;border-color:#10b5c1f7;">Ir a la clase</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
