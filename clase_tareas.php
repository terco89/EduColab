<?php
require_once "includes/config.php";
session_start();
if(!isset($_SESSION["usuario"])){
    header("Location: index.php");
}

if(!isset($_GET["id"])){
    header("Location: clases.php");
}

$sql = "select ClasesEscolares.id,nombre,descripcion,fecha_horario,id_usuario_creador,name from ClasesEscolares inner join usuarios on ClasesEscolares.id_usuario_creador = usuarios.id where ClasesEscolares.id = ".$_GET["id"];
$result = mysqli_fetch_assoc(mysqli_query($link, $sql));

if(!isset($result)){
    header("Location: clases.php");
}

$sql = "select * from tareas where clase_id = ".$result["id"];
$result2 = mysqli_query($link, $sql);
$tareas = array();

// Verificar si se encontraron resultados
if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
        $tareas[] = $row;
    }
}
$view="clase_tareas";
require_once "views/layout.php";