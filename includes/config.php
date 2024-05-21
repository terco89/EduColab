<?php
$link = mysqli_connect("localhost","root","","educolab");

if(!$link){
    die("No se pudo conectar a la base de datos: ".mysqli_connect_errno());
}