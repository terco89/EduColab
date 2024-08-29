<ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <?php if ($espacio): ?>
        <li><a href="espacios.php">Espacios</a></li>
        <li><a href="espacio.php?id=<?php echo $idEspacio; ?>">"<?php echo $espacio['nombre']; ?>"</a></li>

    <?php else: ?>
        <li><a href="clases.php">Clases</a></li>
    <?php endif; ?>
    <li><a href="clase.php?id=<?php echo $id_Clase; ?>">"<?php echo $result['nombre']; ?>"</a></li>
    <li><a class="active" href="clase.php?id=<?php echo $id_Clase; ?>">Alumnos</a></li>

</ul>
<?php require_once "views/clase_navbar.php"; ?>
<!-- Main Container -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .list-group-item {
      display: flex;
      align-items: center;
    }
    .list-group-item img {
      border-radius: 50%;
      margin-right: 15px;
    }
    .list-group-item .name {
      font-size: 1.25rem;
      font-weight: 500;
    }
  </style>

  <div class="container mt-4">
    <?php if(count($alumnos) > 0){
        for($i = 0; $i < count($alumnos);$i++){ ?>
    <ul class="list-group">
      <!-- Persona 1 -->
      <li class="list-group-item">
        <img src="https://via.placeholder.com/50" alt="Persona 1" class="img-fluid rounded-circle">
        <span class="name"><?php echo $alumnos[$i]["name"]; ?></span>
      </li>
    </ul>
    <?php } 
    } ?>
  </div>