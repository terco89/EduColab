<?php
session_start();
if(!isset($_SESSION["usuario"])){
    header("Location: index.php");
}
require_once "includes/config.php";

if (isset($_POST["codigoClase"])) {
    $codigo = $_POST["codigoClase"];

    $sql = "SELECT id FROM ClasesEscolares WHERE LOWER(codigo) = LOWER('$codigo')";
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id_clase = $row["id"];

        $sql_insert = "INSERT INTO clase_usuario (id_usuario, id_clase) VALUES ('".$_SESSION["usuario"]["id"]."', '$id_clase')";

        if (mysqli_query($link, $sql_insert)) {
            echo "Te has unido a la clase correctamente.";
            header("Location: clase.php?id=$id_clase");
        } else {
            echo "Error: " . $sql_insert . "<br>" . mysqli_error($link);
        }
    } else {
        echo "No se encontró ninguna clase con ese código.";
    }
}

$view = "clase_unirse";
require_once "views/layout.php";