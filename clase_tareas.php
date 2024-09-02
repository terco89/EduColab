<?php
require_once "includes/config.php";
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
}

if (!isset($_GET["id"])) {
    header("Location: clases.php");
}
$idEspacio = isset($_GET['espacio']) ? intval($_GET['espacio']) : null;

// Obtener información de la clase
$sql = "SELECT ClasesEscolares.id, ClasesEscolares.nombre, id_usuario_creador, name 
        FROM ClasesEscolares 
        INNER JOIN usuarios ON ClasesEscolares.id_usuario_creador = usuarios.id 
        WHERE ClasesEscolares.id = " . $_GET["id"];
$result = mysqli_fetch_assoc(mysqli_query($link, $sql));

if (!isset($result)) {
    header("Location: clases.php");
}

// Obtener tareas de la clase
$sql = "SELECT * FROM tareas WHERE clase_id = " . $result["id"];
$result2 = mysqli_query($link, $sql);
$tareas = array();

if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
        $tareas[] = $row;
    }
}

// Obtener horarios de la clase
$sql = "SELECT * FROM horarios WHERE id_clase = " . $result["id"];
$result3 = mysqli_query($link, $sql);
$horarios = array();

if (mysqli_num_rows($result3) > 0) {
    while ($row = mysqli_fetch_assoc($result3)) {
        $horarios[] = $row;
    }
}
$espacio = null;
if ($idEspacio) {
    $sqlEspacio = "SELECT nombre FROM Espacios WHERE id = $idEspacio";
    $espacio = mysqli_fetch_assoc(mysqli_query($link, $sqlEspacio));
}
// Verificar si el usuario es un profesor en la clase
$id_clase = intval($_GET["id"]); // Asegúrate de que este ID esté disponible en tu contexto actual
$usuarioId = $_SESSION['usuario']['id'];

$sql = "SELECT 1 FROM clase_profesor WHERE id_clase = ? AND id_usuario = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param('ii', $id_clase, $usuarioId);
$stmt->execute();
$result5 = $stmt->get_result();

// Verifica si el usuario logueado es profesor
$esProfesor = $result5->num_rows > 0;

$view = "clase_tareas";
require_once "views/layout.php";
