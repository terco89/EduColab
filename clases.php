<?php
require_once "includes/config.php";
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
}
$sql = "SELECT * FROM clases INNER JOIN usuarios ON clases.id_usuario = usuarios.id";
$result = mysqli_query($link, $sql);

if (!$result) {
    echo "Fallo consulta: " . mysqli_error($link);
    exit();
}
$clases = mysqli_fetch_all($result, MYSQLI_ASSOC);
$view = "clases";
require_once "views/layout.php";
