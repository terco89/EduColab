<?php
require_once "includes/config.php";
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de espacio no válido.");
}

$idEspacio = intval($_GET['id']); // Asegúrate de que el ID es un número entero

// Obtener detalles del espacio
$sqlEspacio = "SELECT * FROM espacios WHERE id = $idEspacio";
$resultEspacio = $link->query($sqlEspacio);

if ($resultEspacio->num_rows == 0) {
    die("Espacio no encontrado.");
}

$espacio = $resultEspacio->fetch_assoc();

// Obtener clases del espacio
$sqlClases = "
    SELECT c.id, c.nombre, h.dia_semana, h.hora_inicio, h.hora_fin,u.nombre AS nombre_profesor, u.apellido AS apellido_profesor
    FROM clasesescolares c
    JOIN espacios_clases ec ON c.id = ec.id_clase
    JOIN usuarios u ON c.id_usuario_creador = u.id
    LEFT JOIN horarios h ON c.id = h.id_clase
    WHERE ec.id_espacio = $idEspacio
";
$resultClases = $link->query($sqlClases);

if (!$resultClases) {
    die("Error en la consulta: " . $link->error);
}

// Obtener fondos de clases
$sqlFondos = "
    SELECT id_clase, fondo
    FROM clase_usuario
    WHERE id_usuario = {$_SESSION['usuario']['id']}
";
$resultFondos = $link->query($sqlFondos);

$fondos = [];
while ($rowFondo = $resultFondos->fetch_assoc()) {
    $fondos[$rowFondo['id_clase']] = $rowFondo['fondo'];
}

$view = "espacio";
require_once "views/layout.php";
?>
