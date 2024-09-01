<?php require_once "views/clase_navbar.php"; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="css/alumnos.css">

<div class="container mt-4">
  <!-- Mostrar a los Profesores -->
  <div class="d-flex justify-content-between align-items-center">
    <h3 class="profe-header">Profesores</h3>
    <div class="btn-container d-flex">
      <button class="btn btn-outline-success mr-2" data-toggle="modal" data-target="#addProfessorModal">
        <i class="fa-solid fa-user-plus"></i>
      </button>
      <button class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteUserClassModal">
        <i class="fa-solid fa-user-minus"></i>
      </button>
    </div>
  </div>
  <ul class="list-group">
    <?php foreach ($profesores as $profesor): ?>
      <li class="list-group-item">
        <img src="img/foto_perfil/<?php echo htmlspecialchars($profesor["img"]); ?>"
          alt="Imagen de <?php echo htmlspecialchars($profesor["nombre"]); ?>"
          class="img-fluid rounded-circle">
        <span class="name"><?php echo htmlspecialchars($profesor["nombre"]) . ' ' . htmlspecialchars($profesor["apellido"]); ?></span>
        <?php if ($profesor['id'] != $_SESSION['usuario']['id']): ?>
          <button class="btn btn-outline-primary btn-sm btn-copy" data-toggle="modal" data-target="#emailModal" data-email="<?php echo htmlspecialchars($profesor['email']); ?>"><i class="fa-solid fa-envelope"></i></button>
        <?php endif; ?>
      </li>
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

<!-- Modal email -->
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

<!-- Modal Añadir Profesor -->
<div class="modal fade" id="addProfessorModal" tabindex="-1" role="dialog" aria-labelledby="addProfessorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addProfessorModalLabel">Añadir Profesor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Tabs -->
        <ul class="nav nav-tabs" id="addProfessorTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="selectStudent-tab" data-toggle="tab" href="#selectStudent" role="tab" aria-controls="selectStudent" aria-selected="true">Ascender Alumno</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="newUser-tab" data-toggle="tab" href="#newUser" role="tab" aria-controls="newUser" aria-selected="false">Nuevo Usuario</a>
          </li>

        </ul>
        <div class="tab-content" id="addProfessorTabContent"><br>
          <!-- Ascender Alumno -->
          <div class="tab-pane fade show active" id="selectStudent" role="tabpanel" aria-labelledby="selectStudent-tab">
            <h6>Seleccionar un Alumno para Ascender</h6>
            <form action="clase_alumnos.php?id=<?php echo $id_clase; ?>" method="POST">
              <input type="hidden" name="operation_type" value="ascender">
              <div class="form-group">
                <select class="form-control" name="ascender_alumno" id="selectStudentDropdown">
                  <option value="">Seleccionar Alumno</option>
                  <?php foreach ($solo_alumnos as $alumno): ?>
                    <option value="<?php echo htmlspecialchars($alumno['id']); ?>"><?php echo htmlspecialchars($alumno['nombre']) . ' ' . htmlspecialchars($alumno['apellido']); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Ascender Alumno</button>
            </form>
          </div>
          <!-- Nuevo Usuario -->
          <div class="tab-pane fade" id="newUser" role="tabpanel" aria-labelledby="newUser-tab">
            <h6>O Añadir un Usuario Nuevo</h6>
            <form action="clase_alumnos.php?id=<?php echo $id_clase; ?>" method="POST">
              <input type="hidden" name="operation_type" value="newUser">
              <div class="form-group">
                <input type="text" class="form-control" name="newUserName" id="newUserName" placeholder="Nombre del Nuevo Usuario">
              </div>
              <button type="submit" class="btn btn-primary">Añadir Usuario</button>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal eliminar usuarios de la clase -->
<div class="modal fade" id="deleteUserClassModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserClassModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteUserClassModalLabel">¿Desea eliminar a un integrante de la Clase?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="clase_alumnos.php?id=<?php echo $id_clase; ?>">
    <input type="hidden" name="operation_type" value="delete">
    <div class="form-group">
        <select class="form-control" name="delete_user" id="deleteUserDropdown">
            <option value="">Seleccionar Integrante</option>
            <?php foreach ($usuarios as $usuario): ?>
                <?php if ($usuario['id'] != $id_profesor_creador): ?>
                    <option value="<?php echo htmlspecialchars($usuario['id']); ?>">
                        <?php echo htmlspecialchars($usuario['nombre']) . ' ' . htmlspecialchars($usuario['apellido']); ?>
                    </option>
                <?php endif; ?>
            <?php endforeach; ?>
            
        </select>
    </div>
    <button type="submit" class="btn btn-danger">Sí, quiero eliminar a este integrante</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
</form>
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