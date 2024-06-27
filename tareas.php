<?php
session_start();
if(!isset($_SESSION["usuario"])){
    header("Location: index.php");
}

require_once "includes/config.php";

$sql = "select tareas.nombre as n, tarea_usuario.estado as est from tarea_usuario 
inner join tareas on tareas.id = tarea_usuario.tarea_id where tarea_usuario.usuario_id = ".$_SESSION["usuario"]["id"]."";
$result2 = mysqli_query($link, $sql);
$tareas = array();
// Verificar si se encontraron resultados
if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
        $tareas[] = $row;
    }
}

$view = "tareas";
require_once "views/layout.php";