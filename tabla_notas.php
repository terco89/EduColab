<?php
session_start();
if(!isset($_SESSION["usuario"])){
    header("Location: index.php");
}
$view = "tabla_notas";
require_once "views/layout.php";