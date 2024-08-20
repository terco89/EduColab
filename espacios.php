<?php
require_once "includes/config.php";
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre']) && isset($_POST['curso_division'])) {
    $nombre = $link->real_escape_string($_POST['nombre']);
    $cursoDivision = $link->real_escape_string($_POST['curso_division']);
    $clases = isset($_POST['clases']) ? $_POST['clases'] : [];

   
    $sql = "INSERT INTO espacios (nombre, curso_division) VALUES ('$nombre', '$cursoDivision')";
    if ($link->query($sql) === TRUE) {
        $idEspacio = $link->insert_id;

        if (!empty($clases)) {
            foreach ($clases as $idClase) {
                $idClase = $link->real_escape_string($idClase);
                $sql2 = "INSERT INTO espacios_clases (id_espacio, id_clase) VALUES ($idEspacio, $idClase)";
                if ($link->query($sql2) !== TRUE) {
                    echo "Fallo consulta 2: " . $link->error;
                    exit();
                }
            }
        }
    } else {
        echo "Fallo consulta 1: " . $link->error;
        exit();
    }
}

$sql = "SELECT * FROM espacios";
$result = $link->query($sql);
if (!$result) {
    die("Fallo consulta 3: " . $link->error);
}

$sqlClases = "SELECT * FROM clasesescolares";
$resultClases = $link->query($sqlClases);
if (!$resultClases) {
    die("Fallo consulta 4: " . $link->error);
}

$view = "espacios";
require_once "views/layout.php";
?>
