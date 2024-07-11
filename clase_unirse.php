<?php
session_start();
if (!isset($_SESSION["usuario"])) {
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

        $sql_insert = "INSERT INTO clase_usuario (id_usuario, id_clase) VALUES ('" . $_SESSION["usuario"]["id"] . "', '$id_clase')";

        if (mysqli_query($link, $sql_insert)) {
            $sql = "select id from tareas WHERE clase_id = " . $id_clase . " AND fecha_entrega > NOW()";
            $query = mysqli_query($link, $sql);
            $tareas = array();

            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    $tareas[] = $row;
                }
            } else {
                echo "aca";
                die();
                header("Location: clase.php?id=$id_clase");
            }
            $sql = "INSERT INTO tarea_usuario(tarea_id,usuario_id,estado) VALUES ";
            for($i = 0; $i < count($tareas);$i++){
                $sql .= "(".$tareas[$i]["id"].",".$_SESSION["usuario"]["id"].",1)";
                if($i != count($tareas)-1){
                    $sql .= " , ";
                }
            }
            $query = mysqli_query($link, $sql);

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
