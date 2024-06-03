<?php
session_start();
if(!isset($_SESSION["usuario"])){
    header("Location: index.php");
}
$view = "clases";
require_once "views/layout.php";