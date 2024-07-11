<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

if (!isset($_GET["id"])) {
    header("Location: clases.php");
    exit();
}

require_once "includes/config.php";

if (isset($_POST['bg'])) {
    $bg = $_POST['bg'] . ".jpg";
    $sql = "UPDATE clase_usuario SET fondo='" . $bg . "' WHERE id_usuario='" . $_SESSION['usuario']['id'] . "'";
    $result = mysqli_query($link, $sql);
}
$sql = "SELECT fondo FROM clase_usuario WHERE id_usuario='" . $_SESSION['usuario']['id'] . "'";
$query = mysqli_query($link, $sql);
$fondo = mysqli_fetch_assoc($query);
// Obtener información de la clase
$sql = "SELECT ClasesEscolares.id, nombre, descripcion, codigo, id_usuario_creador, name 
        FROM ClasesEscolares 
        INNER JOIN usuarios ON ClasesEscolares.id_usuario_creador = usuarios.id 
        WHERE ClasesEscolares.id = " . $_GET["id"];
$result = mysqli_fetch_assoc(mysqli_query($link, $sql));

if (!$result) {
    header("Location: clases.php");
    exit();
}

// Obtener horarios de la clase
$sql = "SELECT dia_semana, hora_inicio, hora_fin 
        FROM horarios 
        WHERE id_clase = " . $result["id"];
$horarios = mysqli_query($link, $sql);

$view = "clase";
require_once "views/layout.php";
