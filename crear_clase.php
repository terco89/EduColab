<?php
require_once "includes/config.php";
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre'])) {
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

    $nombre = mysqli_real_escape_string($link, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($link, $_POST['descripcion']);
    $id_usuario_creador = $_SESSION["usuario"]['id'];

    // Insertar en clasesescolares
    $sql = "INSERT INTO clasesescolares (nombre, codigo, id_usuario_creador) VALUES ('$nombre', '$codigo', '$id_usuario_creador')";
    $query = mysqli_query($link, $sql);
    if (!$query) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }

    $id_clase = mysqli_insert_id($link);

    // Insertar en clase_usuario
    $sql2 = "INSERT INTO clase_usuario (id_usuario, id_clase, estado) VALUES ('$id_usuario_creador', '$id_clase', 'activa')";
    $query2 = mysqli_query($link, $sql2);
    if (!$query2) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }

    // Insertar en clase_profesor
    $sql3 = "INSERT INTO clase_profesor (id_usuario, id_clase) VALUES ('$id_usuario_creador', '$id_clase')";
    $query3 = mysqli_query($link, $sql3);
    if (!$query3) {
        echo "Fallo consulta al añadir profesor: " . mysqli_error($link);
        exit();
    }

    // Verificar y agregar horarios si están presentes
    if (!empty($_POST['dias_semana']) && !empty($_POST['hora_inicio']) && !empty($_POST['hora_fin'])) {
        $dias_semana = $_POST['dias_semana'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fin = $_POST['hora_fin'];

        for ($i = 0; $i < count($dias_semana); $i++) {
            $dia = mysqli_real_escape_string($link, $dias_semana[$i]);
            $inicio = mysqli_real_escape_string($link, $hora_inicio[$i]);
            $fin = mysqli_real_escape_string($link, $hora_fin[$i]);

            $sql4 = "INSERT INTO horarios (id_clase, nombre_clase, dia_semana, hora_inicio, hora_fin) VALUES ('$id_clase', '$nombre', '$dia', '$inicio', '$fin')";
            $query4 = mysqli_query($link, $sql4);
            if (!$query4) {
                echo "Fallo consulta al añadir horarios: " . mysqli_error($link);
                exit();
            }
        }
    } else {
        echo "Error: Falta uno o más campos requeridos.";
        exit();
    }

    // Redireccionar a la vista de la clase creada
    header('Location: clase.php?id=' . $id_clase);
    exit();
}

$view = "clases";
require_once "views/layout.php";
?>
