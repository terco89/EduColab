<?php
require_once "includes/config.php";
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
}
if (isset($_POST['nombre']) && isset($_POST['seccion']) && isset($_POST['asignatura'])) {
    $sql = "INSERT INTO clases (id,nombre,seccion,asignatura,descripcion,id_usuario) VALUES (null,'" . $_POST['nombre'] . "','" . $_POST['seccion'] . "','" . $_POST['asignatura'] . "', '" . $_POST['descripcion'] . "','" . $_SESSION['usuario']['id'] . "')";
    $query = mysqli_query($link, $sql);
    if (!$query) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }
}
$view = "clases";
require_once "views/layout.php";
