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

$idEspacio = intval($_GET['id']);

// Obtener detalles del espacio
$sqlEspacio = "SELECT * FROM espacios WHERE id = ?";
$stmtEspacio = $link->prepare($sqlEspacio);
$stmtEspacio->bind_param("i", $idEspacio);
$stmtEspacio->execute();
$resultEspacio = $stmtEspacio->get_result();

if ($resultEspacio->num_rows == 0) {
    die("Espacio no encontrado.");
}

$espacio = $resultEspacio->fetch_assoc();

// Obtener clases del espacio con horarios
$sqlClases = "
    SELECT c.id, c.nombre, h.dia_semana, h.hora_inicio, h.hora_fin, u.nombre AS nombre_profesor, u.apellido AS apellido_profesor
    FROM clasesescolares c
    JOIN espacios_clases ec ON c.id = ec.id_clase
    JOIN usuarios u ON c.id_usuario_creador = u.id
    LEFT JOIN horarios h ON c.id = h.id_clase
    WHERE ec.id_espacio = ?
";
$stmtClases = $link->prepare($sqlClases);
$stmtClases->bind_param("i", $idEspacio);
$stmtClases->execute();
$resultClases = $stmtClases->get_result();

// Agrupar horarios por clase
$clases = [];
while ($clase = $resultClases->fetch_assoc()) {
    $id_clase = $clase['id'];
    if (!isset($clases[$id_clase])) {
        $clases[$id_clase] = $clase;
        $clases[$id_clase]['horarios'] = [];
    }
    if ($clase['dia_semana']) {
        $clases[$id_clase]['horarios'][] = [
            'dia_semana' => $clase['dia_semana'],
            'hora_inicio' => $clase['hora_inicio'],
            'hora_fin' => $clase['hora_fin']
        ];
    }
}

// Obtener fondos de clases
$sqlFondos = "
    SELECT id_clase, fondo
    FROM clase_usuario
    WHERE id_usuario = ?
";
$stmtFondos = $link->prepare($sqlFondos);
$stmtFondos->bind_param("i", $_SESSION['usuario']['id']);
$stmtFondos->execute();
$resultFondos = $stmtFondos->get_result();

$fondos = [];
while ($rowFondo = $resultFondos->fetch_assoc()) {
    $fondos[$rowFondo['id_clase']] = $rowFondo['fondo'];
}

$view = "espacio";
require_once "views/layout.php";
?>
