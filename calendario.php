<?php
session_start();
if(!isset($_SESSION["usuario"])){
    header("Location: index.php");
}

require_once "includes/config.php";

$sql = "select tareas.nombre as n, date(tareas.fecha_entrega) as fecha from clase_usuario inner join clase_tarea on clase_tarea.clase_id = clase_usuario.id_clase 
inner join tareas on tareas.clase_id = clase_tarea.tarea_id where clase_usuario.id_usuario = ".$_SESSION["usuario"]["id"]."";
$result2 = mysqli_query($link, $sql);
$tareas = array();
// Verificar si se encontraron resultados
if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
        $tareas[] = $row;
    }
}

$view = "calendario";
require_once "views/layout.php";