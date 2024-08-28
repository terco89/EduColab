<?php
require_once "includes/config.php";
session_start();

// Redirigir si no hay sesión activa
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

// Redirigir si faltan parámetros
if (!isset($_GET["id"]) || !isset($_GET["tid"])) {
    header("Location: clases.php");
    exit();
}

// Función para manejar errores
function handleError($link) {
    echo "Fallo consulta: " . mysqli_error($link);
    exit();
}

// Función para redirigir
function redirect($url) {
    header("Location: $url");
    exit();
}

// Manejo de comentarios
if (isset($_POST["comentario"]) && strlen($_POST["comentario"]) > 0) {
    $sql = "INSERT INTO mensajes_privado(tarea_id, usuario_id, mensaje, fecha_creacion, bandera) VALUES (?, ?, ?, NOW(), true)";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, 'iis', $_GET["tid"], $_SESSION["usuario"]["id"], $_POST["comentario"]);
    if (!mysqli_stmt_execute($stmt)) handleError($link);
    redirect("clase_ver_tarea.php?id=" . $_GET["id"] . "&tid=" . $_GET["tid"]);
}

// Obtener información de la tarea
$sql = "SELECT * FROM tareas WHERE id = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, 'i', $_GET["tid"]);
mysqli_stmt_execute($stmt);
$resultado_tarea = mysqli_stmt_get_result($stmt);
$tarea = mysqli_fetch_assoc($resultado_tarea);
if (!$tarea) redirect("clases.php");

// Obtener información de la clase
$sql_clase = "SELECT ClasesEscolares.id, ClasesEscolares.nombre, id_usuario_creador, name FROM ClasesEscolares INNER JOIN usuarios ON ClasesEscolares.id_usuario_creador = usuarios.id WHERE ClasesEscolares.id = ?";
$stmt = mysqli_prepare($link, $sql_clase);
mysqli_stmt_bind_param($stmt, 'i', $_GET["id"]);
mysqli_stmt_execute($stmt);
$resultado_clase = mysqli_stmt_get_result($stmt);
$clase = mysqli_fetch_assoc($resultado_clase);
if (!$clase) redirect("clases.php");

// Obtener información de los usuarios
$sql_clases = "SELECT DISTINCT tarea_usuario.estado, usuarios.nombre, usuarios.apellido, usuarios.img,usuarios.id FROM tarea_usuario INNER JOIN usuarios ON tarea_usuario.usuario_id = usuarios.id INNER JOIN clase_usuario ON usuarios.id = clase_usuario.id_usuario INNER JOIN clasesescolares ON clase_usuario.id_clase = clasesescolares.id WHERE tarea_id = ?";
$stmt = mysqli_prepare($link, $sql_clases);
mysqli_stmt_bind_param($stmt, 'i', $_GET["tid"]);
mysqli_stmt_execute($stmt);
$resultado_clases = mysqli_stmt_get_result($stmt);

$usuarios = [];
while ($usuario = mysqli_fetch_assoc($resultado_clases)) {
    $usuarios[] = $usuario;
}

// Manejo de entrega (actualización del estado de la tarea)
if (isset($_POST['opcionEntrega'])) {
    if ($_POST['opcionEntrega'] == 'marcar') {
        $sql = "UPDATE tarea_usuario SET estado = '2' WHERE usuario_id = ? AND tarea_id = ?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 'ii', $_SESSION["usuario"]["id"], $_GET["tid"]);
        if (!mysqli_stmt_execute($stmt)) handleError($link);
    } elseif ($_POST['opcionEntrega'] == 'archivo' && isset($_FILES['archivoAdjunto'])) {
        $archivo_nombre = $_FILES['archivoAdjunto']['name'];
        $archivo_temporal = $_FILES['archivoAdjunto']['tmp_name'];
        $nombre = $_GET["tid"] . "_" . $_SESSION["usuario"]["id"];
        mkdir("img/entregas/" . $nombre);
        $ruta = "img/entregas/" . $nombre . "/" . $archivo_nombre;
        if (move_uploaded_file($archivo_temporal, $ruta)) {
            echo "El archivo se ha subido correctamente.";
        } else {
            echo "Error al subir el archivo.";
        }

        $sql = "INSERT INTO entregas(tarea_id, usuario_id, fecha_entrega) VALUES (?, ?, NOW())";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 'ii', $_GET["tid"], $_SESSION['usuario']['id']);
        if (!mysqli_stmt_execute($stmt)) handleError($link);
    }
    redirect("clase_ver_tarea.php?id=" . $_GET["id"] . "&tid=" . $_GET["tid"]);
}

// Obtener recursos adjuntos
$recursos = [];
$dir = "img/tareas/" . $_GET["tid"];
if (file_exists($dir) && is_dir($dir)) {
    $archivos = scandir($dir);
    foreach ($archivos as $archivo) {
        if ($archivo != '.' && $archivo != '..') {
            $info_archivo = pathinfo($archivo);
            $recursos[] = ['nombre' => $info_archivo['filename'], 'extension' => $info_archivo['extension'] ?? ''];
        }
    }
}

// Manejo de mensajes privados
if ($_SESSION["usuario"]["id"] == $clase["id_usuario_creador"] && isset($_POST["nmensaje"]) && isset($_POST["id"])) {
    $sql = "INSERT INTO mensajes_privado(tarea_id, usuario_id, mensaje, fecha_creacion, bandera) VALUES (?, ?, ?, NOW(), false)";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, 'iis', $_GET["tid"], $_POST["id"], $_POST["nmensaje"]);
    if (!mysqli_stmt_execute($stmt)) handleError($link);
}

// Actualización de tarea
if (isset($_POST['nombre_tarea'])) {
    $sql = "UPDATE tareas SET nombre = ?, descripcion = ?, fecha_entrega = ?, clase_id = ? WHERE id = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, 'sssii', $_POST['nombre_tarea'], $_POST['descripcion_tarea'], $_POST['fecha_limite'], $clase["id"], $_GET["tid"]);
    if (!mysqli_stmt_execute($stmt)) handleError($link);

    // Manejo de archivo adjunto en la edición
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
        $archivo_nombre = $_FILES['archivo']['name'];
        $archivo_temporal = $_FILES['archivo']['tmp_name'];
        $nombre = $_GET["tid"];
        mkdir("img/tareas/" . $nombre);
        $ruta = "img/tareas/" . $nombre . "/" . $archivo_nombre;
        if (move_uploaded_file($archivo_temporal, $ruta)) {
            echo "El archivo se ha subido correctamente.";
        } else {
            echo "Error al subir el archivo.";
        }
    }
    redirect("clase_ver_tarea.php?id=" . $_GET["id"] . "&tid=" . $_GET["tid"]);
}

// Eliminación de tarea
if (isset($_POST['eliminar'])) {
    $sql = "DELETE FROM tareas WHERE id = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $_GET["tid"]);
    if (!mysqli_stmt_execute($stmt)) handleError($link);
    redirect("clases.php");
}

// Obtener mensajes privados
if ($_SESSION["usuario"]["id"] == $clase["id_usuario_creador"]) {
    $sql = "SELECT usuarios.id, name, mensaje, bandera FROM mensajes_privado INNER JOIN usuarios ON mensajes_privado.usuario_id = usuarios.id WHERE tarea_id = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $_GET["tid"]);
    mysqli_stmt_execute($stmt);
    $query = mysqli_stmt_get_result($stmt);

    $general = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $general[] = $row;
    }
}

// Cargar vista
$view = "clase_ver_tareas";
require_once "views/layout.php";
