<?php require_once "views/clase_navbar.php"; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="css/alumnos.css">

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
          <?php if ($usuario['id'] != $_SESSION['usuario']['id']): ?>
            <button class="btn btn-outline-primary btn-sm btn-copy" data-toggle="modal" data-target="#emailModal" data-email="<?php echo htmlspecialchars($usuario['email']); ?>"><i class="fa-solid fa-envelope"></i></button>
          <?php endif; ?>
        </li>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>

  <!-- Mostrar a los Alumnos y la cantidad -->
  <h3 class="profe-header">Alumnos (<?php echo $total_alumnos; ?>)</h3>
  <ul class="list-group">
    <?php foreach ($solo_alumnos as $alumno): ?>
      <li class="list-group-item">
        <img src="img/foto_perfil/<?php echo htmlspecialchars($alumno["img"]); ?>"
          alt="Imagen de <?php echo htmlspecialchars($alumno["nombre"]); ?>"
          class="img-fluid rounded-circle">
        <span class="name"><?php echo htmlspecialchars($alumno["nombre"]) . ' ' . htmlspecialchars($alumno["apellido"]); ?></span>
        <?php if ($alumno['id'] != $_SESSION['usuario']['id']): ?>
          <button class="btn btn-outline-primary btn-sm btn-copy" data-toggle="modal" data-target="#emailModal" data-email="<?php echo htmlspecialchars($alumno['email']); ?>"><i class="fa-solid fa-envelope"></i></button>
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
  </ul>
</div>

<!-- Modal email-->
<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="emailModalLabel">Email</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="email-container">
          <p id="emailText"></p>
          <button type="button" class="btn btn-outline-secondary" id="copyEmail"><i class="fa-solid fa-copy"></i></button>
        </div>
      </div>
     
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  $('#emailModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var email = button.data('email');
    var modal = $(this);
    modal.find('#emailText').text(email);
    modal.find('#copyEmail').data('email', email);
  });

  $('#copyEmail').on('click', function() {
    var email = $(this).data('email');
    navigator.clipboard.writeText(email).then(function() {
      alert('Email copiado al portapapeles.');
    }, function(err) {
      alert('Error al copiar el email: ' + err);
    });
  });
</script>