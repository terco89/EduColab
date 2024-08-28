<?php
require_once "includes/config.php";

session_start();

if (!isset($_SESSION["usuario"]) || !isset($_GET['id']) || !is_numeric($_GET['id'])) {// matenme por favor
    header("Location: index.php");
    exit();
}

$id_clase = intval($_GET['id']); 
$idEspacio = isset($_GET['espacio']) ? intval($_GET['espacio']) : null;

///cambiar fondo
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['bgOption'])) {
        $bgOption = $_POST['bgOption'];

        if ($bgOption == 'background' && isset($_POST['bg'])) {
            $bg = $_POST['bg'];
            $allowed_backgrounds = ['bg1.jpg', 'bg2.jpg', 'bg3.jpg', 'bg4.jpg', 'bg5.jpg', 'bg6.jpg', 'bg7.jpg', 'bg8.jpg', 'bg9.jpg', 'bg10.jpg'];

            if (in_array($bg, $allowed_backgrounds)) {
                $stmt = $link->prepare("UPDATE clase_usuario SET fondo=? WHERE id_usuario=? AND id_clase=?");
                $stmt->bind_param("ssi", $bg, $_SESSION['usuario']['id'], $id_clase);
                $stmt->execute();
            }
        } elseif ($bgOption == 'color' && isset($_POST['color'])) {
            $color = $_POST['color'];

            $stmt = $link->prepare("UPDATE clase_usuario SET fondo=? WHERE id_usuario=? AND id_clase=?");
            $stmt->bind_param("ssi", $color, $_SESSION['usuario']['id'], $id_clase);
            $stmt->execute();
        }
    }
}
///mostrar dondo
$stmt = $link->prepare("SELECT fondo, estado FROM clase_usuario WHERE id_usuario=? AND id_clase=?");
$stmt->bind_param("ii", $_SESSION['usuario']['id'], $id_clase);
$stmt->execute();
$result = $stmt->get_result();
$fondo = $result->fetch_assoc();

//obtebner cosas de clases
$sql = "SELECT ClasesEscolares.id, ClasesEscolares.nombre, codigo, id_usuario_creador, usuarios.apellido as profe_apellido, usuarios.nombre as profe_nombre
        FROM ClasesEscolares 
        INNER JOIN usuarios ON ClasesEscolares.id_usuario_creador = usuarios.id 
        WHERE ClasesEscolares.id = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $id_clase);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

if (!$result) {
    header("Location: clases.php");
    exit();
}
// Obtener los horarrios 
$sql = "SELECT dia_semana, hora_inicio, hora_fin 
        FROM horarios 
        WHERE id_clase = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $result["id"]);
$stmt->execute();
$horarios = $stmt->get_result();

// Borrar la classe
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_clase_eliminar"])) {
    $id_clase_eliminar = intval($_POST["id_clase_eliminar"]);
    $stmt = $link->prepare("DELETE FROM horarios WHERE id_clase = ?");
    $stmt->bind_param("i", $id_clase_eliminar);
    $stmt->execute();
    $stmt = $link->prepare("DELETE FROM ClasesEscolares WHERE id = ?");
    $stmt->bind_param("i", $id_clase_eliminar);
    if ($stmt->execute()) {
        header("Location: clases.php");
        exit();
    } else {
        echo "Error al eliminar la clase: " . $stmt->error;
    }
}
// Archivar la classe
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_clase_archivar"])) {
    $id_clase_archivar = intval($_POST["id_clase_archivar"]);
    $stmt = $link->prepare("UPDATE `clase_usuario` SET `estado`='archivada' WHERE clase_usuario.id_clase=?");
    $stmt->bind_param("i", $id_clase_archivar);
    $stmt->execute();
    if ($stmt->execute()) {
        header("Location: clase_archivada.php");
        exit();
    } else {
        echo "Error al eliminar la clase: " . $stmt->error;
    }
}
// desArchivar la classe
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_clase_desarchivar"])) {
    $id_clase_desarchivar = intval($_POST["id_clase_desarchivar"]);
    $stmt = $link->prepare("UPDATE `clase_usuario` SET `estado`='activa' WHERE clase_usuario.id_clase=?");
    $stmt->bind_param("i", $id_clase_desarchivar);
    $stmt->execute();
    if ($stmt->execute()) {
        header("Location: clases.php");
        exit();
    } else {
        echo "Error al eliminar la clase: " . $stmt->error;
    }
}

$espacio = null;
if ($idEspacio) {
    $sqlEspacio = "SELECT nombre FROM Espacios WHERE id = $idEspacio";
    $espacio = mysqli_fetch_assoc(mysqli_query($link, $sqlEspacio));
}
$view = "clase";
require_once "views/layout.php";
?>
