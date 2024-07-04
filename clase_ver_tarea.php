<?php
require_once "includes/config.php";
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

if (!isset($_GET["id"]) || !isset($_GET["tid"])) {
    header("Location: clases.php");
    exit();
}

// Obtener información de la tarea
$sql = "SELECT * FROM tareas WHERE id = ".$_GET["tid"];
$resultado_tarea = mysqli_query($link, $sql);
$tarea = mysqli_fetch_assoc($resultado_tarea);

if (!$tarea) {
    header("Location: clases.php");
    exit();
}

// Obtener información de la clase
$sql_clase = "SELECT ClasesEscolares.id, nombre, descripcion, id_usuario_creador, name
             FROM ClasesEscolares 
             INNER JOIN usuarios ON ClasesEscolares.id_usuario_creador = usuarios.id 
             WHERE ClasesEscolares.id = ".$_GET["id"];
$resultado_clase = mysqli_query($link, $sql_clase);
$clase = mysqli_fetch_assoc($resultado_clase);

if (!$clase) {
    header("Location: clases.php");
    exit();
}

// Obtener los recursos adjuntos de la tarea
$recursos = array();
if (file_exists("img/tareas/".$_GET["tid"]) && is_dir("img/tareas/".$_GET["tid"])) {
    $archivos = scandir("img/tareas/".$_GET["tid"]);

    foreach ($archivos as $archivo) {
        if ($archivo != '.' && $archivo != '..') {
            $info_archivo = pathinfo($archivo);
            $nombre = $info_archivo['filename'];
            $extension = isset($info_archivo['extension']) ? $info_archivo['extension'] : '';
            $recursos[] = $nombre;
            $recursos[] = $extension;
        }
    }
}

$view = "clase_ver_tareas";
require_once "views/layout.php";
?>
