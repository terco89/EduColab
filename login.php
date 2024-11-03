<?php
require_once "includes/config.php";
session_start();

if (isset($_SESSION["usuario"])) {
    header("Location: clases.php");
    exit();
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['name']) || empty($_POST['password'])) {
        $errors[] = "Todos los campos son obligatorios.";
    } else {
        $name = $_POST['name'];
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM usuarios WHERE name = '" . mysqli_real_escape_string($link, $name) . "'";
        $result = mysqli_query($link, $sql);
        
        if (!$result) {
            $errors[] = "Fallo consulta: " . mysqli_error($link);
        } else {
            if (mysqli_num_rows($result) == 0) {
                $errors[] = "El nombre de usuario no existe.";
            } else {
                $user = mysqli_fetch_assoc($result);
                if (md5($password) != $user['password']) {
                    $errors[] = "La contraseña es incorrecta.";
                } else {
                    $_SESSION['usuario'] = $user;
                    header('Location: clases.php');
                    exit();
                }
            }
        }
    }
}

$section = "login";
require_once "views/login.php";
?>
