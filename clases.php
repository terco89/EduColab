<?php
require_once "includes/config.php";
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
}
$view = "clases";
$id_usuario = $_SESSION["usuario"]["id"];
$sql = "SELECT ClasesEscolares.* FROM ClasesEscolares 
            INNER JOIN clase_usuario ON ClasesEscolares.id = clase_usuario.id_clase 
            WHERE clase_usuario.id_usuario = $id_usuario";

$result = mysqli_query($link, $sql);
$clases = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $clases[] = $row;
    }
}

require_once "views/layout.php";
