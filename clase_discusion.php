<?php
session_start();
if(!isset($_SESSION["usuario"])){
    header("Location: index.php");
}


require_once "includes/config.php";

if(isset($_POST["did"]) && isset($_POST["mensaje"])){
    $sql = "insert into mensajes(id_usuario,id_discusion,mensaje,fecha_creacion) values(".$_SESSION["usuario"]["id"].",".$_POST["did"].",'".$_POST["mensaje"]."',NOW())";
    $query = mysqli_query($link, $sql);
    if($query){
        print("exito");
    }
    else{
        print("no exito: ".mysqli_error($link));
    }
    die();
}

if((!isset($_GET["id"]) || !isset($_GET['did']))){
    header("Location: clases.php");
}

$sql = "select ClasesEscolares.id,nombre,descripcion,fecha_horario,name from ClasesEscolares inner join usuarios on ClasesEscolares.id_usuario_creador = usuarios.id where ClasesEscolares.id = ".$_GET["id"];
$result = mysqli_fetch_assoc(mysqli_query($link, $sql));

if(!isset($result)){
    header("Location: clases.php");
}



$sql = "select * from discusiones where id = ".$_GET["did"];
$disc = mysqli_fetch_assoc(mysqli_query($link, $sql));

if(!isset($disc)){
    header("Location: clases.php");
}

$sql = "select mensaje,name,img,fecha_creacion from mensajes inner join usuarios on mensajes.id_usuario = usuarios.id where id_discusion = ".$_GET["did"];
$query = mysqli_query($link, $sql);
$mensajes = array();
// Verificar si se encontraron resultados
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $mensajes[] = $row;
    }
}

$view = "clase_discusion";
require_once "views/layout.php";