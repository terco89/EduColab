<br>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="titulo-ancho-completo">
                <h1>Calendario escolar</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mx-auto my-auto">
            <div class="card">
                <div id='calendar' class="card-body">
                </div>
            </div>
        </div>
    </div>
</div>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            events: [
                <?php for($i = 0; $i < count($tareas); $i++){ ?>
                {
                    title: 'Tarea: <?php echo $tareas[$i]["n"]; ?>',
                    start: '<?php echo $tareas[$i]["fecha"]; ?>', // Fecha de la tarea
                    backgroundColor: 'orange',
                },
                <?php } ?>
                // Puedes agregar más eventos aquí para otras tareas en diferentes fechas
            ]
        });
        calendar.render();
    });
    $(document).ready(function() {
        $(".fc-event-title").click(function() {
            console.log(this);
        });
        $(".fc-event-title").hover(function() {
            $(".fc-event-title").toggleClass("click");
        });
    });
</script>
<style>
    .click {
        cursor: pointer;
    }

    .titulo-ancho-completo {
        background-color: #007bff;
        /* Fondo azul */
        color: #ffffff;
        /* Letras blancas */
        padding: 20px 0;
        /* Espaciado interno */
        text-align: center;
        /* Alineación del texto */
    }
</style>