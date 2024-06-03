<?php
session_start();
if(!isset($_SESSION["usuario"])){
    header("Location: index.php");
}
$view = "clase_foro";
require_once "views/layout.php";