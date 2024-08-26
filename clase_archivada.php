<?php
require_once "includes/config.php";
session_start();
$view = "clase_archivada";
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}
$id_usuario = $_SESSION["usuario"]["id"];
$sqlArchivada = "SELECT c.id, c.nombre AS nombre_clase, c.codigo, c.id_usuario_creador, h.dia_semana, h.hora_inicio, h.hora_fin, u.nombre AS nombre_profesor, u.apellido AS apellido_profesor, cu.fondo
        FROM clasesescolares c
        INNER JOIN horarios h ON c.id = h.id_clase
        INNER JOIN clase_usuario cu ON c.id = cu.id_clase
        INNER JOIN usuarios u ON c.id_usuario_creador = u.id
        WHERE cu.id_usuario = $id_usuario && cu.estado='archivada'";

$resultArchivada = mysqli_query($link, $sqlArchivada);
if (!$resultArchivada) {
    echo "Fallo consulta: " . mysqli_error($link);
    exit();
}
$clases = array();
while ($row = mysqli_fetch_assoc($resultArchivada)) {
    $clase_id = $row['id'];
    $nombre_clase = ucfirst(strtolower($row['nombre_clase']));

    if (!isset($clases[$clase_id])) {
        $clases[$clase_id] = [
            'id' => $row['id'],
            'nombre' => $nombre_clase,
            'codigo' => $row['codigo'],
            'id_usuario_creador' => $row['id_usuario_creador'],
            'nombre_profesor' => $row['nombre_profesor'],
            'apellido_profesor' => $row['apellido_profesor'],
            'fondo'=>$row['fondo'],
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