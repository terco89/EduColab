<?php
require_once "includes/config.php";
session_start();
if(isset($_SESSION["usuario"])){
    header("Location: clases.php");
}
if (isset($_POST['name']) && isset($_POST['password'])) {
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
$section = "login";
require_once "views/login.php";