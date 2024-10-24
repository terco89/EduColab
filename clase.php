<?php
require_once "includes/config.php";
session_start();

if (!isset($_SESSION["usuario"]) || !isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id_usuario = $_SESSION["usuario"]["id"];
$id_clase = intval($_GET['id']);
$idEspacio = isset($_GET['espacio']) ? intval($_GET['espacio']) : null;

// Cambiar fondo
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
                header("Location: clase.php?id=$id_clase");
                exit();
            }
        } elseif ($bgOption == 'color' && isset($_POST['color'])) {
            $color = $_POST['color'];

            // Verifica si el color tiene un formato correcto, por ejemplo un color hexadecimal
            if (preg_match('/^#[0-9A-Fa-f]{6}$/', $color)) {
                $stmt = $link->prepare("UPDATE clase_usuario SET fondo=? WHERE id_usuario=? AND id_clase=?");
                $stmt->bind_param("ssi", $color, $_SESSION['usuario']['id'], $id_clase);
                $stmt->execute();
                header("Location: clase.php?id=$id_clase");
                exit();
            } else {
                // Manejo de error si el color no es válido
                echo "Color no válido.";
            }
        }
    }
}

// Mostrar fondo
$stmt = $link->prepare("SELECT fondo, estado FROM clase_usuario  WHERE id_usuario=? AND id_clase=?");
$stmt->bind_param("ii", $_SESSION['usuario']['id'], $id_clase);
$stmt->execute();
$result = $stmt->get_result();
$fondo = $result->fetch_assoc();

// Obtener los datos de la clase
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

// Obtener los horarios
$sql = "SELECT dia_semana, hora_inicio, hora_fin FROM horarios WHERE id_clase = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $result["id"]);
$stmt->execute();
$horarios = $stmt->get_result();

// Obtener profesores adicionales
$sql = "SELECT usuarios.id, usuarios.nombre,usuarios.apellido 
        FROM clase_profesor 
        JOIN usuarios ON clase_profesor.id_usuario = usuarios.id 
        WHERE clase_profesor.id_clase = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param('i', $id_clase);
$stmt->execute();
$result5 = $stmt->get_result();

$profesores = [];
while ($row = $result5->fetch_assoc()) {
    $profesores[] = $row;
}

$espacio = null;
if ($idEspacio) {
    $sqlEspacio = "SELECT nombre FROM Espacios WHERE id = $idEspacio";
    $espacio = mysqli_fetch_assoc(mysqli_query($link, $sqlEspacio));
}
if (isset($_POST['id_clase_archivar'])) {
    $sql = "UPDATE clase_usuario SET estado = 'archivada' WHERE id_clase = $id_clase AND id_usuario = $id_usuario";
    $res = mysqli_query($link, $sql);
    if (!$res) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }else{
        header("location: clases.php");
    }
}
if (isset($_POST['id_clase_desarchivar'])) {
    $sql = "UPDATE clase_usuario SET estado = 'activa' WHERE id_clase = $id_clase AND id_usuario = $id_usuario";
    $res = mysqli_query($link, $sql);
    if (!$res) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }else{
        header("location: clases.php");
    }
}
if (isset($_POST['id_clase_eliminar'])) {
    $sql = "UPDATE clase_usuario SET estado = 'inactiva' WHERE id_clase = $id_clase AND id_usuario = $id_usuario";
    $res = mysqli_query($link, $sql);
    if (!$res) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }else{
        header("location: clases.php");
    }
}
// Cargar vista
$view = "clase";
require_once "views/layout.php";
