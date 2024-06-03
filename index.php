<?php
session_start();
if(isset($_SESSION["usuario"])){
    header("Location: clases.php");
}
$view = "home";
require_once "views/layout.php";