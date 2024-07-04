<?php
require_once "includes/config.php";
session_start();
if(!isset($_SESSION["usuario"])){
    header("Location: index.php");
}

if(!isset($_GET["id"]) || !isset($_GET["tid"])){
    header("Location: clases.php");
}

$sql = "select ClasesEscolares.id,nombre,descripcion,fecha_horario,id_usuario_creador,name from ClasesEscolares inner join usuarios on ClasesEscolares.id_usuario_creador = usuarios.id where ClasesEscolares.id = ".$_GET["id"];
$result = mysqli_fetch_assoc(mysqli_query($link, $sql));

if(!isset($result)){
    header("Location: clases.php");
}
$recursos = array();
if (file_exists("img/tareas/".$_GET["tid"]) && is_dir("img/tareas/".$_GET["tid"])) {
    $archivos = scandir("img/tareas/".$_GET["tid"]);

    // Recorrer los archivos y mostrar nombres y extensiones
    foreach ($archivos as $archivo) {
        // Excluir los directorios '.' y '..'
        if ($archivo != '.' && $archivo != '..') {
            // Obtener nombre y extensión del archivo
            $info_archivo = pathinfo($archivo);
            $nombre = $info_archivo['filename']; // Nombre del archivo
            $extension = isset($info_archivo['extension']) ? $info_archivo['extension'] : ''; // Extensión del archivo (si existe)
            $recursos[] = $nombre;
            $recursos[] = $extension;
        }
    }
}

$sql = "select * from tareas where id = ".$_GET["tid"];
$tarea = mysqli_fetch_assoc(mysqli_query($link, $sql));

$view="clase_ver_tareas";
require_once "views/layout.php";