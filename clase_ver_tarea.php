<?php
require_once "includes/config.php";
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

if (!isset($_GET["id"]) || !isset($_GET["tid"])) {
    header("Location: clases.php");
    exit();
}

// Obtener información de la tarea
$sql = "SELECT * FROM tareas WHERE id = " . $_GET["tid"];
$resultado_tarea = mysqli_query($link, $sql);
$tarea = mysqli_fetch_assoc($resultado_tarea);

if (!$tarea) {
    header("Location: clases.php");
    exit();
}
$sql = "SELECT * FROM entregas WHERE tarea_id = " . $_GET["tid"]." AND usuario_id = ".$_SESSION["usuario"]["id"]." ";
$resultado_entrega = mysqli_query($link, $sql);
$entrega = mysqli_fetch_assoc($resultado_entrega);
// Obtener información de la clase
$sql_clase = "SELECT ClasesEscolares.id, ClasesEscolares.nombre, descripcion, id_usuario_creador, name
             FROM ClasesEscolares 
             INNER JOIN usuarios ON ClasesEscolares.id_usuario_creador = usuarios.id 
             WHERE ClasesEscolares.id = " . $_GET["id"];
$resultado_clase = mysqli_query($link, $sql_clase);
$clase = mysqli_fetch_assoc($resultado_clase);

if (!$clase) {
    header("Location: clases.php");
    exit();
}

// Obtener los recursos adjuntos de la tarea
$recursos = array();
if (file_exists("img/tareas/" . $_GET["tid"]) && is_dir("img/tareas/" . $_GET["tid"])) {
    $archivos = scandir("img/tareas/" . $_GET["tid"]);

    foreach ($archivos as $archivo) {
        if ($archivo != '.' && $archivo != '..') {
            $info_archivo = pathinfo($archivo);
            $nombre = $info_archivo['filename'];
            $extension = isset($info_archivo['extension']) ? $info_archivo['extension'] : '';
            $recursos[] = $nombre;
            $recursos[] = $extension;
        }
    }
}

if (isset($_POST['titulo'])) {
    $sql = "UPDATE tareas SET nombre = '" . $_POST['titulo'] . "', descripcion = '" . $_POST['instruccion'] . "', fecha_subida = NOW(), fecha_entrega = '" . $_POST['fecha_limite'] . "', clase_id = '" . $clase["id"] . "' WHERE id = " . $_GET["tid"];
    $query = mysqli_query($link, $sql);
    if (!$query) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }
    $tid = mysqli_insert_id($link);
    $sql = "select id_usuario from clase_usuario where id_usuario != " . $_SESSION["usuario"]["id"] . " and id_clase = " . $clase["id"];
    $query = mysqli_query($link, $sql);
    $ids = array();
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $ids[] = $row;
        }
    }
    for ($i = 0; $i < count($ids); $i++) {
        $sql = "INSERT INTO tarea_usuario(tarea_id,usuario_id,estado) VALUES($tid," . $ids[$i]["id_usuario"] . ",1)";
        $query = mysqli_query($link, $sql);
        if (!$query) {
            echo "Fallo consulta: " . mysqli_error($link);
            exit();
        }
    }

    if (isset($_SESSION['usuario']) && isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
        $archivo_nombre = $_FILES['archivo']['name'];
        $archivo_temporal = $_FILES['archivo']['tmp_name'];
        $nombre = $tid;
        mkdir("img/tareas/" . $nombre . "");
        $ruta = "img/tareas/" . $nombre . "/" . $archivo_nombre;
        if (move_uploaded_file($archivo_temporal, $ruta)) {
            echo "El archivo se ha subido correctamente.";
        } else {
            echo "Error al subir el archivo.";
        }
    }
    echo '<script>window.location.href = "clase_ver_tarea.php?id=' . $result["id"] . '&tid=' . $tid . '";</script>';
    exit();
}
if (isset($_POST['eliminar'])) {
    $sql = "DELETE FROM tareas WHERE id = " . $_GET["tid"];
    $query = mysqli_query($link, $sql);
    if (!$query) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }
    header('Location: clases.php');
}
if (isset($_FILES["archivoEntrega"])) {
    $sql = "INSERT INTO entregas(tarea_id,usuario_id,fecha_entrega) VALUES(" . $_GET["tid"] . "," . $_SESSION['usuario']['id'] . ",NOW())";
    $query = mysqli_query($link, $sql);
    if (!$query) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }
    $archivo_nombre = $_FILES['archivoEntrega']['name'];
    $archivo_temporal = $_FILES['archivoEntrega']['tmp_name'];
    $nombre = $_GET["tid"]."&".$_SESSION["usuario"]["id"];
    mkdir("img/entregas/" . $nombre . "");
    $ruta = "img/entregas/" . $nombre . "/" . $archivo_nombre;
    if (move_uploaded_file($archivo_temporal, $ruta)) {
        echo "El archivo se ha subido correctamente.";
    } else {
        echo "Error al subir el archivo.";
    }
    header('Location: clase_ver_tarea.php?id='.$_GET["id"].'&tid='.$_GET["tid"]);
}

$view = "clase_ver_tareas";
require_once "views/layout.php";
