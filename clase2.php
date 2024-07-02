<?php
require_once "includes/config.php";
session_start();
if(!isset($_SESSION["usuario"])){
    header("Location: index.php");
}

if(isset($_POST['bg'])){
    $bg=$_POST['bg'].".jpg";
    $sql="UPDATE clase_usuario SET fondo='".$bg."' WHERE id_usuario='".$_SESSION['usuario']['id']."'";
    $query=mysqli_query($link,$sql);
}
$sql="SELECT fondo FROM clase_usuario WHERE id_usuario='".$_SESSION['usuario']['id']."'";

$query=mysqli_query($link,$sql);
$fondo=mysqli_fetch_assoc($query);
$view = "clase2";
require_once "views/layout.php";