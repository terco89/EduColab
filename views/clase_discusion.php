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
        <br>


        <!-- Mensajes -->
        <div id="mensajes">
            <?php
            if (isset($mensajes) && count($mensajes) > 0) {
                for ($i = 0; $i < count($mensajes); $i++) { ?>
                    <div class="message">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $mensajes[$i]["name"] ?></h5>
                                <p class="card-text"><?php echo $mensajes[$i]["mensaje"] ?></p>
                                <p class="card-text"><small class="text-muted"></small><?php echo $mensajes[$i]["fecha_creacion"]; ?></p>
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <h2>Se el primero en empezar el debate</h2>
            <?php } ?>
        </div>
        <!-- Formulario para nuevo mensaje -->
        <br>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Agregar Nuevo Mensaje</h5>
                <form id="miFormulario">
                    <div class="form-group">
                        <div class="form-group">
                            <textarea class="form-control" id="mensaje" name="mensaje" rows="3" required></textarea>
                        </div>
                        <input type="text" name="did" id="did" hidden value="<?php echo $_GET["did"] ?>">
                        <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                </form>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function() {
            // Cuando se envíe el formulario
            $('#miFormulario').submit(function(e) {
                e.preventDefault(); // Evita que se recargue la página

                // Datos del formulario
                var formData = {
                    'mensaje': $('#mensaje').val(),
                    'did': $('#did').val()
                };

                // Envío de datos mediante AJAX
                $.ajax({
                    type: 'POST',
                    url: 'clase_discusion.php', // URL donde procesas los datos en el servidor
                    data: formData,
                    success: function(response) {
                        var fechaActual = new Date();

                        // Formatear la fecha y hora según tus necesidades
                        var dia = fechaActual.getDate();
                        var mes = fechaActual.getMonth() + 1; // Los meses comienzan desde 0
                        var año = fechaActual.getFullYear();
                        var horas = fechaActual.getHours();
                        var minutos = fechaActual.getMinutes();
                        var segundos = fechaActual.getSeconds();

                        // Ajustar formato para que siempre tenga dos dígitos
                        if (mes < 10) {
                            mes = '0' + mes;
                        }
                        if (dia < 10) {
                            dia = '0' + dia;
                        }
                        if (horas < 10) {
                            horas = '0' + horas;
                        }
                        if (minutos < 10) {
                            minutos = '0' + minutos;
                        }
                        if (segundos < 10) {
                            segundos = '0' + segundos;
                        }

                        // Construir la cadena de fecha y hora en el formato deseado (ejemplo: DD/MM/YYYY HH:MM:SS)
                        var fechaHoraActual = dia + '/' + mes + '/' + año + ' ' + horas + ':' + minutos + ':' + segundos;

                        document.getElementById("mensajes").innerHTML += '<div class="message"><div class="card"><div class="card-body"><h5 class="card-title"><?php echo $_SESSION["usuario"]["name"] ?></h5><p class="card-text">'+$('#mensaje').val()+'</p><p class="card-text"><small class="text-muted"></small>'+fechaHoraActual+'</p></div></div></div>'
                    },
                    error: function(error) {}
                });
            });
        });
    </script>