<?php
session_start();
if(!isset($_SESSION["usuario"])){
    header("Location: index.php");
}
if(!isset($_GET["id"])){
    header("Location: clases.php");
}

require_once "includes/config.php";

$sql = "select ClasesEscolares.id,nombre,descripcion,name from ClasesEscolares inner join usuarios on ClasesEscolares.id_usuario_creador = usuarios.id where ClasesEscolares.id = ".$_GET["id"];
$result = mysqli_fetch_assoc(mysqli_query($link, $sql));
$view = "temas";
require_once "views/layout.php";