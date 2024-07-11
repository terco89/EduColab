<?php
require_once "includes/config.php";
session_start();
if(!isset($_SESSION["usuario"])){
    header("Location: index.php");
}

function generarCodigo($longitud = 16) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ____';
    $codigo = '';
    $maxCaracteres = strlen($caracteres) - 1;

    for ($i = 0; $i < $longitud; $i++) {
        $codigo .= $caracteres[mt_rand(0, $maxCaracteres)];
    }

    return $codigo;
}
$codigo = generarCodigo();

if (isset($_POST['none'])) {
    $img = $_POST['none'];
    $sql = "UPDATE usuarios SET img = '" . $img . "' WHERE ID = '" . $_SESSION['usuario']['id'] . "'";
    $query = mysqli_query($link, $sql);
    if (!$query) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }
    $_SESSION['usuario']['img'] = $img;
}else if (isset($_POST['alumno'])) {
    $img = $_POST['alumno'];
    $sql = "UPDATE usuarios SET img = '" . $img . "' WHERE ID = '" . $_SESSION['usuario']['id'] . "'";
    $query = mysqli_query($link, $sql);
    if (!$query) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }
    $_SESSION['usuario']['img'] = $img;
}else if (isset($_POST['profesor'])) {
    $img = $_POST['profesor'];
    $sql = "UPDATE usuarios SET img = '" . $img . "' WHERE ID = '" . $_SESSION['usuario']['id'] . "'";
    $query = mysqli_query($link, $sql);
    if (!$query) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }
    $_SESSION['usuario']['img'] = $img;
}else if (isset($_POST['sec'])) {
    $img = $_POST['sec'];
    $sql = "UPDATE usuarios SET img = '" . $img . "' WHERE ID = '" . $_SESSION['usuario']['id'] . "'";
    $query = mysqli_query($link, $sql);
    if (!$query) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }
    $_SESSION['usuario']['img'] = $img;
}
$sql = "SELECT COUNT(id_clase) AS cic FROM clase_usuario WHERE id_usuario='".$_SESSION['usuario']['id']."'";
$query=mysqli_query($link,$sql);
$clses=mysqli_fetch_assoc($query);

$sql = "SELECT COUNT(id) AS ce FROM clasesescolares WHERE id_usuario_creador='".$_SESSION['usuario']['id']."'";
$query=mysqli_query($link,$sql);
$clses2=mysqli_fetch_assoc($query);

$view = "miperfil";
require_once "views/layout.php";