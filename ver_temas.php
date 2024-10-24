<?php
require_once "includes/config.php";
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

// Obtener el ID del usuario logueado
$usuarioId = $_SESSION['usuario']['id'];

// Verificar si el usuario es un profesor en la clase
$id_clase = intval($_GET["id"]); // Asegúrate de que este ID esté disponible en tu contexto actual

$sql = "SELECT 1 FROM clase_profesor WHERE id_clase = ? AND id_usuario = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param('ii', $id_clase, $usuarioId);
$stmt->execute();
$result = $stmt->get_result();

// Verifica si el usuario logueado es profesor
$esProfesor = $result->num_rows > 0;

// Continuar con la lógica existente para obtener la clase, tema, y recursos...
if (isset($_GET["tid"])) {
    // Obtener información del tema
    $sql = "SELECT * FROM temas WHERE id = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param('i', $_GET["tid"]);
    $stmt->execute();
    $resultado_tema = $stmt->get_result();

    if ($resultado_tema && $resultado_tema->num_rows > 0) {
        $tema = $resultado_tema->fetch_assoc();
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
             WHERE ClasesEscolares.id = ?";
$stmt = $link->prepare($sql_clase);
$stmt->bind_param('i', $id_clase);
$stmt->execute();
$resultado_clase = $stmt->get_result();

if ($resultado_clase && $resultado_clase->num_rows > 0) {
    $clase = $resultado_clase->fetch_assoc(); 
} else {
    $clase = null; // Definir clase como null si no se encuentra
}
if (isset($_POST['id_tema_editar'])) {
    $sql = "UPDATE temas SET nombre = '" . $_POST['nombre'] . "', descripcion = '" . $_POST['descripcion'] . "', fecha_alta = NOW(), id_clase = $id_clase WHERE id = " . $_GET["tid"];
    $query = mysqli_query($link, $sql);
    if (!$query) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }
    header("Location: clases.php");
    exit();
}
if (isset($_POST['id_tema_eliminar'])) {
    $sql = "DELETE FROM temas WHERE id = " . $_GET["tid"];
    $query = mysqli_query($link, $sql);
    if (!$query) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }
    header('Location: clase.php?id='.$_GET['id']);
}
// Define la vista y otros parámetros
$view = "ver_temas";
require_once "views/layout.php";
