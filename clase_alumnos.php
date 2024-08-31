<?php
require_once "includes/config.php";

session_start();

if (!isset($_SESSION["usuario"]) || !isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id_clase = intval($_GET['id']); 
$idEspacio = isset($_GET['espacio']) ? intval($_GET['espacio']) : null;

// Obtener información de la clase y del profesor
$sql = "SELECT ClasesEscolares.id, ClasesEscolares.nombre, codigo, id_usuario_creador, 
               usuarios.apellido as profe_apellido, usuarios.nombre as profe_nombre 
        FROM ClasesEscolares 
        INNER JOIN usuarios ON ClasesEscolares.id_usuario_creador = usuarios.id 
        WHERE ClasesEscolares.id = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $id_clase);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$nombre_clase= $result["nombre"];
if (!$result) {
    header("Location: clases.php");
    exit();
}

$id_profesor = $result['id_usuario_creador']; 

$sql = "SELECT usuarios.* 
        FROM clase_usuario 
        INNER JOIN usuarios ON clase_usuario.id_usuario = usuarios.id 
        WHERE clase_usuario.id_clase = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $id_clase);
$stmt->execute();
$result1 = $stmt->get_result();
$usuarios = $result1->fetch_all(MYSQLI_ASSOC); 
$solo_alumnos = array_filter($usuarios, function($usuario) use ($id_profesor) {
    return $usuario['id'] != $id_profesor;
});
$total_alumnos = count($solo_alumnos);

// Obtener información del espacio si existe
$espacio = null;
if ($idEspacio) {
    $sqlEspacio = "SELECT nombre FROM Espacios WHERE id = ?";
    $stmtEspacio = $link->prepare($sqlEspacio);
    $stmtEspacio->bind_param("i", $idEspacio);
    $stmtEspacio->execute();
    $espacio = $stmtEspacio->get_result()->fetch_assoc();
}

$view = "clase_alumnos";
require_once "views/layout.php";
?>
