<?php
session_start();
if(!isset($_SESSION["usuario"])){
    header("Location: index.php");
}
$view = "calendario";
require_once "views/layout.php";