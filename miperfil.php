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

if (isset($_POST['alumno'])) {
    $img = $_POST['alumno'];
    $sql = "UPDATE usuarios SET img = '" . $img . "' WHERE ID = '" . $_SESSION['usuario']['id'] . "'";
    $query = mysqli_query($link, $sql);
    if (!$query) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }
    $_SESSION['usuario']['img'] = $img;
}else if (isset($_POST['alumno2'])) {
    $img = $_POST['alumno2'];
    $sql = "UPDATE usuarios SET img = '" . $img . "' WHERE ID = '" . $_SESSION['usuario']['id'] . "'";
    $query = mysqli_query($link, $sql);
    if (!$query) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }
    $_SESSION['usuario']['img'] = $img;
}else if (isset($_POST['alumno3'])) {
    $img = $_POST['alumno3'];
    $sql = "UPDATE usuarios SET img = '" . $img . "' WHERE ID = '" . $_SESSION['usuario']['id'] . "'";
    $query = mysqli_query($link, $sql);
    if (!$query) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }
    $_SESSION['usuario']['img'] = $img;
}else if (isset($_POST['eve'])) {
    $img = $_POST['eve'];
    $sql = "UPDATE usuarios SET img = '" . $img . "' WHERE ID = '" . $_SESSION['usuario']['id'] . "'";
    $query = mysqli_query($link, $sql);
    if (!$query) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }
    $_SESSION['usuario']['img'] = $img;
}


$view = "miperfil";
require_once "views/layout.php";