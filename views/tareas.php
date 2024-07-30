<div class="container">
  <br>
  <h1>Tareas</h1>
  <br>
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-header bg-danger text-light">
          <h5 class="card-title">Tareas Pendientes</h5>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <?php for($i = 0; $i < count($tareas); $i++){ 
              if(intval($tareas[$i]["est"]) == 1){?>
            <li class="list-group-item tarea"><a href="clase_ver_tarea.php?id=<?php echo $tareas[$i]["clase_id"]; ?>&tid=<?php echo $tareas[$i]["id"]; ?>"><?php echo $tareas[$i]["n"] ?></a></li>
            <?php } } ?>
          </ul>
        </div>
      </div>
    </div>

    <div class="col-md-4 ">
      <div class="card">
        <div class="card-header bg-success text-light">
          <h5 class="card-title">Tareas Completadas</h5>
        </div>
        <div class="card-body">
          <ul class="list-group">
          <?php for($i = 0; $i < count($tareas); $i++){ 
              if(intval($tareas[$i]["est"]) == 2){?>
            <li class="list-group-item tarea"><?php echo $tareas[$i]["n"] ?></li>
            <?php } } ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header bg-info  text-light">
          <h5 class="card-title">Tareas Corregidas</h5>
        </div>
        <div class="card-body">
          <ul class="list-group">
          <?php for($i = 0; $i < count($tareas); $i++){ 
              if(intval($tareas[$i]["est"]) == 3){?>
            <li class="list-group-item tarea"><?php echo $tareas[$i]["n"] ?></li>
            <?php } } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .tarea {
      transition: background-color 0.3s ease;
    }
    .tarea:hover {
      background-color: rgba(0, 0, 0, 0.1); /* Cambiar el último valor para ajustar el nivel de oscurecimiento */
    }
</style>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




<!---style>
  .ag-format-container {
  width: 1080px;
  margin: 0 auto;
  height: 500px;
}


.ag-courses_box {
  display: -webkit-box;

  padding: 50px 0;
}
.ag-courses_item {
  -ms-flex-preferred-size: calc(33.33333% - 30px);
  flex-basis: calc(33.33333% - 30px);

  margin: 0 15px 30px;

  overflow: hidden;

  border-radius: 28px;
}
.ag-courses-item_link {
  display: block;
  padding: 30px 20px;
  background-color: #121212;

  overflow: hidden;

  position: relative;
}
.ag-courses-item_link:hover,
.ag-courses-item_link:hover .ag-courses-item_date {
  text-decoration: none;
  color: #FFF;
}
.ag-courses-item_link:hover .ag-courses-item_bg {
  -webkit-transform: scale(10);
  -ms-transform: scale(10);
  transform: scale(10);
}
.ag-courses-item_title {
  min-height: 87px;
  margin: 0 0 25px;

  overflow: hidden;

  font-weight: bold;
  font-size: 15px;
  color: #FFF;

  z-index: 2;
  position: relative;
}


.ag-courses-item_bg {
  height: 128px;
  width: 128px;
  background-color: green;

  z-index: 1;
  position: absolute;
  top: -75px;
  right: -75px;

  border-radius: 50%;

  -webkit-transition: all .5s ease;
  -o-transition: all .5s ease;
  transition: all .5s ease;
}




@media only screen and (max-width: 979px) {
  .ag-courses_item {
    -ms-flex-preferred-size: calc(50% - 30px);
    flex-basis: calc(50% - 30px);
  }
  
}

@media only screen and (max-width: 767px) {
  .ag-format-container {
    width: 96%;
  }

}
@media only screen and (max-width: 639px) {
  .ag-courses_item {
    -ms-flex-preferred-size: 100%;
    flex-basis: 100%;
  }
  
  .ag-courses-item_link {
    padding: 22px 40px;
  }
  
}
</style>

<div class="ag-format-container">
  <div class="ag-courses_box">
    <div class="ag-courses_item">
      <a href="#" class="ag-courses-item_link">
        <div class="ag-courses-item_bg"></div>

        <div class="ag-courses-item_title">
          UI/Web&amp;Graph design for teenagers 11-17&#160;years old
        </div>
      </a>
    </div>
  </div>
</div--------------->