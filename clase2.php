<?php
session_start();
if(!isset($_SESSION["usuario"])){
    header("Location: index.php");
}
$view = "clase2";
require_once "views/layout.php";