<?php
require_once "includes/config.php";

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $pass = md5($_POST['password']);
    $sql = "INSERT INTO usuarios (id,name,password,email,rol,img) VALUES (null,'". $_POST['name']."','". $pass ."','". ($_POST['email'])."','alumno','Profesor.jpg')";
    $query = mysqli_query($link, $sql);

    if (!$query) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }else{
        header("Location: login.php");
    }
}
$section = "signup";
require_once "views/register.php";