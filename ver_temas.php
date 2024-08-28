<?php
require_once "includes/config.php";
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}
if (isset($_GET["tid"])) {
    // Obtener información del tema
    $sql = "SELECT * FROM temas WHERE id = " . intval($_GET["tid"]);
    $resultado_tema = mysqli_query($link, $sql);

    if ($resultado_tema && mysqli_num_rows($resultado_tema) > 0) {
        $tema = mysqli_fetch_assoc($resultado_tema);
    } else {
        $tema = null; // Definir tema como null si no se encuentra
    }

    // Obtener los recursos adjuntos de la tarea solo si el tema existe
    $recursos = array();
    if ($tema && file_exists("img/temas/" . $_GET["tid"]) && is_dir("img/temas/" . $_GET["tid"])) {
        $archivos = scandir("img/temas/" . $_GET["tid"]);

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
}


// Obtener información de la clase
$sql_clase = "SELECT *
             FROM ClasesEscolares 
             INNER JOIN usuarios ON ClasesEscolares.id_usuario_creador = usuarios.id 
             WHERE ClasesEscolares.id = " . intval($_GET["id"]);
$resultado_clase = mysqli_query($link, $sql_clase);

if ($resultado_clase && mysqli_num_rows($resultado_clase) > 0) {
    $clase = mysqli_fetch_assoc($resultado_clase); // Deberías usar mysqli_fetch_assoc() para obtener un array asociativo
} else {
    $clase = null; // Definir clase como null si no se encuentra
}


////tema eliminar, ya borren esta madre
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_tema_eliminar"])) {

    $id_tema_eliminar = intval($_POST["id_tema_eliminar"]);

    $stmt = $link->prepare("DELETE FROM tema_usuario WHERE tema_id = ?");
    $stmt->bind_param("i", $id_tema_eliminar);
    $stmt->execute();
    $stmt = $link->prepare("DELETE FROM temas WHERE id = ?");
    $stmt->bind_param("i", $id_tema_eliminar);
    if ($stmt->execute()) {
        header("Location: clase.php?id=".$_GET["id"]);
        exit();
    } else {
        echo "Error al eliminar la clase: " . $stmt->error;
    }
}
////ediare tmea
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nombre"]) && isset($_POST["descripcion"]) && isset($_POST["id_tema_editar"])) {
    $id_edit_tema = intval($_POST["id_tema_editar"]);
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $stmt = $link->prepare("UPDATE temas SET nombre= ? ,descripcion = ? WHERE id= ? ");
    $stmt->bind_param("ssi", $nombre, $descripcion, $id_edit_tema);
    if ($stmt->execute()) {
        header("Location: ver_temas.php?id=" . $_GET["id"] . "&tid=" . $_GET["tid"]);
    }
}
$view = "ver_temas";
require_once "views/layout.php";
