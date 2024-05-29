<?php require_once "views/clase_navbar.php"; ?>

    <!-- Main Container -->
    <div class="container mt-5">
        <!-- Header -->
        <div class="jumbotron">
            <h1 class="display-4">Foro de Discusión</h1>
            <p class="lead">Participa en los debates y haz preguntas sobre los temas de clase.</p>
        </div>

        <!-- Nuevo Tema de Discusión -->
        <div class="card mb-4">
            <div class="card-header">
                Crear Nuevo Tema de Discusión
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="topicTitle">Título del Tema</label>
                        <input type="text" class="form-control" id="topicTitle" placeholder="Ingresa el título del tema">
                    </div>
                    <div class="form-group">
                        <label for="topicContent">Contenido del Tema</label>
                        <textarea class="form-control" id="topicContent" rows="3" placeholder="Escribe el contenido del tema"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Tema</button>
                </form>
            </div>
        </div>

        <!-- Lista de Temas de Discusión -->
        <div class="card mb-4">
            <div class="card-header">
                Temas de Discusión
            </div>
            <div class="card-body">
                <!-- Tema 1 -->
                <div class="media mb-3">
                    <img src="https://via.placeholder.com/64" class="mr-3" alt="User Avatar">
                    <div class="media-body">
                        <h5 class="mt-0">Análisis de la Poesía Moderna</h5>
                        <p>Discusión sobre las características y autores más representativos de la poesía moderna.</p>
                        <p><small class="text-muted">Publicado por Juan López el 25 de mayo, 2024</small></p>
                        <a href="#" class="btn btn-secondary btn-sm">Ver Tema</a>
                    </div>
                </div>
                <!-- Tema 2 -->
                <div class="media mb-3">
                    <img src="https://via.placeholder.com/64" class="mr-3" alt="User Avatar">
                    <div class="media-body">
                        <h5 class="mt-0">Interpretación de Metáforas</h5>
                        <p>¿Cómo interpretan las metáforas en los poemas que hemos leído en clase?</p>
                        <p><small class="text-muted">Publicado por Ana García el 24 de mayo, 2024</small></p>
                        <a href="#" class="btn btn-secondary btn-sm">Ver Tema</a>
                    </div>
                </div>
                <!-- Tema 3 -->
                <div class="media mb-3">
                    <img src="https://via.placeholder.com/64" class="mr-3" alt="User Avatar">
                    <div class="media-body">
                        <h5 class="mt-0">Influencia del Romanticismo</h5>
                        <p>Explora la influencia del romanticismo en la poesía contemporánea.</p>
                        <p><small class="text-muted">Publicado por Carlos Mendoza el 23 de mayo, 2024</small></p>
                        <a href="#" class="btn btn-secondary btn-sm">Ver Tema</a>
                    </div>
                </div>
                <!-- Más temas pueden ser añadidos aquí -->
            </div>
        </div>
    </div>