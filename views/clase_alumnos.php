<?php require_once "views/clase_navbar.php"; ?>

<style>
  .list-group-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px; 
  }

  .list-group-item img {
    border-radius: 50%;
    margin-right: 15px;
    width: 50px; 
    height: 50px;
    object-fit: cover; 
  }

  .list-group-item .name {
    font-size: 1.25rem;
    font-weight: 500;
  }

  .profe-header {
    font-size: 1.5rem;
    font-weight: bold;
    margin-top: 20px;
  }
</style>

<div class="container mt-4">
  <!-- Mostrar al Profesor -->
  <h3 class="profe-header">Profesor</h3>
  <ul class="list-group">
    <?php foreach ($usuarios as $usuario): ?>
      <?php if ($usuario['id'] == $id_profesor): ?>
        <li class="list-group-item">
          <img src="img/foto_perfil/<?php echo htmlspecialchars($usuario["img"]); ?>" 
               alt="Imagen de <?php echo htmlspecialchars($usuario["nombre"]); ?>" 
               class="img-fluid rounded-circle">
          <span class="name"><?php echo htmlspecialchars($usuario["nombre"]) . ' ' . htmlspecialchars($usuario["apellido"]); ?></span>
        </li>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>

  <!-- Mostrar a los Alumnos y la cantisad -->
  <h3 class="profe-header">Alumnos (<?php echo $total_alumnos; ?>)</h3>
  <ul class="list-group">
    <?php foreach ($solo_alumnos as $alumno): ?>
      <li class="list-group-item">
        <img src="img/foto_perfil/<?php echo htmlspecialchars($alumno["img"]); ?>" 
             alt="Imagen de <?php echo htmlspecialchars($alumno["nombre"]); ?>" 
             class="img-fluid rounded-circle">
        <span class="name"><?php echo htmlspecialchars($alumno["nombre"]) . ' ' . htmlspecialchars($alumno["apellido"]); ?></span>
      </li>
    <?php endforeach; ?>
  </ul>
</div>
