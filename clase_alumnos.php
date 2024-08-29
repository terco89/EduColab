<?php
require_once "includes/config.php";

session_start();

if (!isset($_SESSION["usuario"]) || !isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id_clase = intval($_GET['id']); 
$idEspacio = isset($_GET['espacio']) ? intval($_GET['espacio']) : null;


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

$sql = "select name from clase_usuario INNER JOIN usuarios ON clase_usuario.id_usuario = usuarios.id WHERE clase_usuario.id_clase = ".$_GET["id"];
$query = mysqli_query($link,$sql);
$alumnos= array();
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $alumnos[] = $row;
    }
}

$espacio = null;
if ($idEspacio) {
    $sqlEspacio = "SELECT nombre FROM Espacios WHERE id = $idEspacio";
    $espacio = mysqli_fetch_assoc(mysqli_query($link, $sqlEspacio));
}
$view = "clase_alumnos";
require_once "views/layout.php";
?>
