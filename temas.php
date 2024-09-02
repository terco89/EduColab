<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
}
if (!isset($_GET["id"])) {
    header("Location: clases.php");
}

require_once "includes/config.php";

$sql = "select ClasesEscolares.*,name from ClasesEscolares inner join usuarios on ClasesEscolares.id_usuario_creador = usuarios.id where ClasesEscolares.id = " . $_GET["id"];
$result = mysqli_fetch_assoc(mysqli_query($link, $sql));


$sql = "SELECT * FROM temas WHERE id_clase = " . $result["id"];
$result2 = mysqli_query($link, $sql);
$temas = array();

if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
        $temas[] = $row;
    }
}
$idEspacio = isset($_GET['espacio']) ? intval($_GET['espacio']) : null;

if ($idEspacio === null) {
    die("ID de espacio no válido.");
}
if (isset($_POST['titulo'])) {
    $sql = "INSERT INTO temas (id, nombre, descripcion, fecha_alta, id_clase) 
            VALUES (null, '" . $_POST['titulo'] . "', '" . $_POST['instruccion'] . "', NOW(), '" . $result["id"] . "')";
    $query = mysqli_query($link, $sql);
    if (!$query) {
        echo "Fallo consulta: " . mysqli_error($link);
        exit();
    }
    $tid = mysqli_insert_id($link);
    $sql = "SELECT id_usuario FROM clase_usuario WHERE id_clase = " . $result["id"];
    $query = mysqli_query($link, $sql);
    $ids = array();
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $ids[] = $row;
        }
    }
    for ($i = 0; $i < count($ids); $i++) {
        $sql = "INSERT INTO tema_usuario(tema_id,usuario_id) VALUES($tid," . $ids[$i]["id_usuario"] . ")";
        $query = mysqli_query($link, $sql);
        if (!$query) {
            echo "Fallo consulta: " . mysqli_error($link);
            exit();
        }
    }
    if (isset($_SESSION['usuario']) && isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
        $archivo_nombre = $_FILES['archivo']['name'];
        $archivo_temporal = $_FILES['archivo']['tmp_name'];
        $nombre = $tid; 
        mkdir("img/temas/" . $nombre . "");
        $ruta = "img/temas/" . $nombre . "/" . $archivo_nombre;
        if (move_uploaded_file($archivo_temporal, $ruta)) {
            echo "El archivo se ha subido correctamente.";
        } else {
            echo "Error al subir el archivo.";
        }
    }

    header("Location: ver_temas.php?id=" . $_GET["id"] . "&tid=" . $tid);
    exit();
}
$id_clase = $_GET["id"];
$espacio = null;
if ($idEspacio) {
    $sqlEspacio = "SELECT nombre FROM Espacios WHERE id = $idEspacio";
    $espacio = mysqli_fetch_assoc(mysqli_query($link, $sqlEspacio));
}
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
$view = "temas";

require_once "views/layout.php";
