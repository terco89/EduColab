<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
}
if (!isset($_GET["id"])) {
    header("Location: clases.php");
}

require_once "includes/config.php";

$sql = "select ClasesEscolares.*,name from ClasesEscolares inner join usuarios on ClasesEscolares.id_usuario_creador = usuarios.id where ClasesEscolares.id = " . $_GET["id"];
$result = mysqli_fetch_assoc(mysqli_query($link, $sql));


$sql = "SELECT * FROM temas WHERE id_clase = " . $result["id"];
$result2 = mysqli_query($link, $sql);
$temas = array();

if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
        $temas[] = $row;
    }
}

if (isset($_POST['titulo'])) {
    $sql = "INSERT INTO temas (id, nombre, descripcion, fecha_alta, id_clase) 
            VALUES (null, '" . $_POST['titulo'] . "', '" . $_POST['instruccion'] . "', NOW(), '" . $result["id"] . "')";
    $query = mysqli_query($link, $sql);
    if (!$query) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }
    $tid = mysqli_insert_id($link);
    $sql = "select id_usuario from clase_usuario where id_clase = " . $result["id"];
    $query = mysqli_query($link, $sql);
    $ids = array();
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $ids[] = $row;
        }
    }
    for ($i = 0; $i < count($ids); $i++) {
        $sql = "INSERT INTO tema_usuario(tema_id,usuario_id) VALUES($tid," . $ids[$i]["id_usuario"] . ")";
        $query = mysqli_query($link, $sql);
        if (!$query) {
            echo "Fallo consulta: " . mysqli_error($link);
            exit();
        }
    }
    if (isset($_SESSION['usuario']) && isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
        $archivo_nombre = $_FILES['archivo']['name'];
        $archivo_temporal = $_FILES['archivo']['tmp_name'];
        $nombre = mysqli_insert_id($link);
        mkdir("img/temas/" . $nombre . "");
        $ruta = "img/temas/" . $nombre . "/" . $archivo_nombre;
        if (move_uploaded_file($archivo_temporal, $ruta)) {
            echo "El archivo se ha subido correctamente.";
        } else {
            echo "Error al subir el archivo.";
        }
    }
    
    echo '<script>window.location.href = "ver_temas.php?id=' . $result["id"] . '&tid=' . mysqli_insert_id($link) . '";</script>';
    exit();
}
$view = "temas";
require_once "views/layout.php";
