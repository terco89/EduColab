<?php
require_once "includes/config.php";
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
}
if (isset($_POST['nombre'])) {
    function generarCodigo($longitud = 6) {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codigo = '';
        $maxCaracteres = strlen($caracteres) - 1;
    
        for ($i = 0; $i < $longitud; $i++) {
            $codigo .= $caracteres[mt_rand(0, $maxCaracteres)];
        }
    
        return $codigo;
    }
    $codigo = generarCodigo();

    $sql = "INSERT INTO clasesescolares (id,nombre,fecha_horario,codigo,id_usuario_creador) VALUES (null,'" . $_POST['nombre'] . "','" . $_POST['horarios'] . "','" . $codigo . "','".$_SESSION["usuario"]['id']."')";
    $query = mysqli_query($link, $sql);
    if (!$query) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }

    $id_clase = mysqli_insert_id($link);
    $id_usuario = $_SESSION["usuario"]['id'];
    $sql2 = "INSERT INTO clase_usuario (id_usuario, id_clase) VALUES ('$id_usuario', '$id_clase')";
    $query2 = mysqli_query($link, $sql2);
    if (!$query2) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }

    header('location: clases.php');
}

$view = "clases";
require_once "views/layout.php";
