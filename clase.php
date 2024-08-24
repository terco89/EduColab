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
    $bg = $_POST['bg'];
    $id_clase=$_GET['id'];
    
    $allowed_backgrounds = ['bg1.jpg', 'bg2.jpg', 'bg3.jpg','bg4.jpg','bg5.jpg','bg6.jpg','bg7.jpg','bg8.jpg','bg9.jpg','bg10.jpg']; 
    if (in_array($bg, $allowed_backgrounds)) {
        $stmt = $link->prepare("UPDATE clase_usuario SET fondo=? WHERE id_usuario=? AND id_clase=?");
        $stmt->bind_param("ssi", $bg, $_SESSION['usuario']['id'],$id_clase);
        $stmt->execute();
    }
}
$stmt = $link->prepare("SELECT fondo FROM clase_usuario WHERE id_usuario=? AND id_clase=?");
$stmt->bind_param("si", $_SESSION['usuario']['id'], $_GET['id']);
$stmt->execute();
$result = $stmt->get_result();
$fondo = $result->fetch_assoc();

// Obtener información de la clase
$sql = "SELECT ClasesEscolares.id, ClasesEscolares.nombre, codigo, id_usuario_creador, name 
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
