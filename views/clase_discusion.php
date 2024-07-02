<?php require_once "views/clase_navbar.php"; ?>

    <!-- Main Container -->
<body>
    <div class="container">
        <!-- Tema de Discusión -->
        <div class="alert alert-primary" role="alert">
            <h4 class="alert-heading">Tema: <?php echo $disc["tema"]; ?></h4>
            <p><?php echo $disc["contenido"]; ?></p>
            <hr>
            <p class="mb-0">Aquí puedes ver y participar en la discusión sobre este tema.</p>
        </div>

        
        <!-- Mensajes -->
        <?php
        if(isset($mensajes)){
        for($i = 0; $i < count($mensajes); $i++){ ?>
        <div class="message">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $mensajes[$i]["nombre"] ?></h5>
                    <p class="card-text"><?php echo $mensajes[$i]["mensaje"] ?></p>
                    <p class="card-text"><small class="text-muted"></small><?php echo $mensajes[$i]["fecha_creacion"]; ?></p>
                </div>
            </div>
        </div>
        <?php } 
        } else{?>
        <h2>Se el primero en empezar el debate</h2>
        <?php } ?>
        <!-- Formulario para nuevo mensaje -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Agregar Nuevo Mensaje</h5>
                <form method="POST" action="procesar_mensaje.php">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="mensaje">Mensaje:</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                </form>
            </div>
        </div>

    </div>
