<?php
session_start();
if(!isset($_SESSION["usuario"])){
    header("Location: index.php");
}

if(!isset($_GET["id"])){
    header("Location: clases.php");
}

require_once "includes/config.php";

if(isset($_POST["tema"]) && $_POST["contenido"] && $_POST["id"]){
    $sql = "INSERT INTO discusiones(id_alumno,id_clase,tema,contenido,fecha_creacion) VALUES(".$_SESSION["usuario"]["id"].",".$_POST["id"].",'".$_POST["tema"]."','".$_POST["contenido"]."',NOW())";
    $query = mysqli_query($link,$sql);
    header("Location: clase_discusion.php?id=".$_POST["id"]."&did=".mysqli_insert_id($link));
}

$sql = "select ClasesEscolares.id,ClasesEscolares.nombre,descripcion,name from ClasesEscolares inner join usuarios on ClasesEscolares.id_usuario_creador = usuarios.id where ClasesEscolares.id = ".$_GET["id"];
$result = mysqli_fetch_assoc(mysqli_query($link, $sql));

if(!isset($result)){
    header("Location: clases.php");
}

$sql = "select discusiones.id as id, tema,contenido,name,fecha_creacion from discusiones inner join usuarios on discusiones.id_alumno = usuarios.id where id_clase = ".$_GET["id"];
$query = mysqli_query($link, $sql);
$discusiones = array();

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $discusiones[] = $row;
    }
}

$view = "clase_foro";
require_once "views/layout.php";