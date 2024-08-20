<?php
require_once "includes/config.php";

$view = "clases";
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

$id_usuario = $_SESSION["usuario"]["id"];
$sql = "SELECT c.*, h.dia_semana, h.hora_inicio, h.hora_fin 
        FROM clasesescolares c
        INNER JOIN horarios h ON c.id = h.id_clase
        INNER JOIN clase_usuario cu ON c.id = cu.id_clase
        WHERE cu.id_usuario = $id_usuario";

$result = mysqli_query($link, $sql);
if (!$result) {
    echo "Fallo consulta: " . mysqli_error($link);
    exit();
}

$clases = array();
while ($row = mysqli_fetch_assoc($result)) {
    $clase_id = $row['id'];

    $nombre_clase = ucfirst(strtolower($row['nombre']));


    if (!isset($clases[$clase_id])) {
        $clases[$clase_id] = [
            'id' => $row['id'],
            'nombre' => $nombre_clase,
            'codigo' => $row['codigo'],
            'id_usuario_creador' => $row['id_usuario_creador'],
            'horarios' => []
        ];
       

    }

    $clases[$clase_id]['horarios'][] = [
        'dia_semana' => $row['dia_semana'],
        'hora_inicio' => $row['hora_inicio'],
        'hora_fin' => $row['hora_fin']
    ];
}


require_once "views/layout.php";
?>