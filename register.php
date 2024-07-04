<?php
require_once "includes/config.php";
session_start();
if (isset($_SESSION["usuario"])) {
    header("Location: clases.php");
    exit();
}

$errors = array();

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "El correo electrónico no es válido.";
    }
    if (!preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#\$%\^&\*])(?=.{8,})/', $password)) {
        $errors[] = "La contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial.";
    }
    $sql_email = "SELECT id FROM usuarios WHERE email = '$email'";
    $result_email = mysqli_query($link, $sql_email);
    if (mysqli_num_rows($result_email) > 0) {
        $errors[] = "El correo electrónico ya está registrado.";
    }
    $sql_name = "SELECT id FROM usuarios WHERE name = '$name'";
    $result_name = mysqli_query($link, $sql_name);
    if (mysqli_num_rows($result_name) > 0) {
        $errors[] = "El nombre de usuario ya está registrado.";
    }

    if (empty($errors)) {
        $pass = md5($password);
        $sql = "INSERT INTO usuarios (id, name, password, email, rol, img) VALUES (null, '$name', '$pass', '$email', 'alumno', 'alumno.jpg')";
        $query = mysqli_query($link, $sql);

        if (!$query) {
            $errors[] = "Fallo consulta: " . mysqli_error($link);
        } else {
            $sql = "SELECT * FROM usuarios WHERE name = '$name' AND password = '$pass'";
            $result = mysqli_query($link, $sql);

            if (!$result) {
                $errors[] = "Fallo consulta: " . mysqli_error($link);
            } else if (mysqli_num_rows($result) == 1) {
                $_SESSION['usuario'] = mysqli_fetch_assoc($result);
                header('Location: index.php');
                exit();
            }
        }
    }
}

$section = "signup";
require_once "views/register.php";
?>
