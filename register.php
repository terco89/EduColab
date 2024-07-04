<?php
require_once "includes/config.php";
session_start();
if(isset($_SESSION["usuario"])){
    header("Location: clases.php");
}
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    
    $pass = md5($_POST['password']);
    $sql = "INSERT INTO usuarios (id,name,password,email,img) VALUES (null,'". $_POST['name']."','". $pass ."','". ($_POST['email'])."','alumno.jpg')";
    $query = mysqli_query($link, $sql);

    if (!$query) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }else{
        $name = $_POST['name'];
    $pass = md5($_POST['password']);
    $sql = "SELECT * FROM usuarios 
            WHERE name = '" . $name . "'
            AND password = '" . $pass . "'";
    $result = mysqli_query($link, $sql);
    
    if (!$result) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['usuario'] = mysqli_fetch_assoc($result);
        header('Location: index.php');
    }
    }
}
$section = "signup";
require_once "views/register.php";