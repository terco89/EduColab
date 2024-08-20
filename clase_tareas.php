<?php
require_once "includes/config.php";
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
}

if (!isset($_GET["id"])) {
    header("Location: clases.php");
}

// Obtener información de la clase
$sql = "SELECT ClasesEscolares.id, ClasesEscolares.nombre, id_usuario_creador, name 
        FROM ClasesEscolares 
        INNER JOIN usuarios ON ClasesEscolares.id_usuario_creador = usuarios.id 
        WHERE ClasesEscolares.id = " . $_GET["id"];
$result = mysqli_fetch_assoc(mysqli_query($link, $sql));

if (!isset($result)) {
    header("Location: clases.php");
}

// Obtener tareas de la clase
$sql = "SELECT * FROM tareas WHERE clase_id = " . $result["id"];
$result2 = mysqli_query($link, $sql);
$tareas = array();

if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
        $tareas[] = $row;
    }
}

// Obtener horarios de la clase
$sql = "SELECT * FROM horarios WHERE id_clase = " . $result["id"];
$result3 = mysqli_query($link, $sql);
$horarios = array();

if (mysqli_num_rows($result3) > 0) {
    while ($row = mysqli_fetch_assoc($result3)) {
        $horarios[] = $row;
    }
}

$view = "clase_tareas";
require_once "views/layout.php";
