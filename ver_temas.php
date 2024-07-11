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
$sql = "SELECT * FROM temas WHERE id = ".$_GET["tid"];
$resultado_tema = mysqli_query($link, $sql);
$tema = mysqli_fetch_assoc($resultado_tema);

if (!$tema) {
    header("Location: clases.php");
    exit();
}

// Obtener información de la clase
$sql_clase = "SELECT id_usuario_creador
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
if (file_exists("img/temas/".$_GET["tid"]) && is_dir("img/temas/".$_GET["tid"])) {
    $archivos = scandir("img/temas/".$_GET["tid"]);

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

$view = "ver_temas";
require_once "views/layout.php";
?>
