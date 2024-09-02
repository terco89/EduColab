<?php
require_once "includes/config.php";
session_start();
$view = "clases";
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

$id_usuario = $_SESSION["usuario"]["id"];

// Clases activas con profesores ascendidos
$sqlActivas = "
    SELECT c.id, c.nombre AS nombre_clase, c.codigo, c.id_usuario_creador, h.dia_semana, h.hora_inicio, h.hora_fin, 
           COALESCE(pu.nombre, u.nombre) AS nombre_profesor, COALESCE(pu.apellido, u.apellido) AS apellido_profesor, 
           cu.fondo
    FROM clasesescolares c
    INNER JOIN horarios h ON c.id = h.id_clase
    INNER JOIN clase_usuario cu ON c.id = cu.id_clase
    LEFT JOIN usuarios u ON c.id_usuario_creador = u.id
    LEFT JOIN clase_profesor cp ON c.id = cp.id_clase AND cp.id_usuario = $id_usuario
    LEFT JOIN usuarios pu ON cp.id_usuario = pu.id
    WHERE (cu.id_usuario = $id_usuario OR c.id_usuario_creador = $id_usuario)
    AND cu.estado = 'activa'
";

$resultActivas = mysqli_query($link, $sqlActivas);
if (!$resultActivas) {
    echo "Fallo consulta: " . mysqli_error($link);
    exit();
}

// Clases archivadas con profesores ascendidos
$sqlArchivada = "
    SELECT c.id, c.nombre AS nombre_clase, c.codigo, c.id_usuario_creador, h.dia_semana, h.hora_inicio, h.hora_fin, 
           COALESCE(pu.nombre, u.nombre) AS nombre_profesor, COALESCE(pu.apellido, u.apellido) AS apellido_profesor, 
           cu.fondo
    FROM clasesescolares c
    INNER JOIN horarios h ON c.id = h.id_clase
    INNER JOIN clase_usuario cu ON c.id = cu.id_clase
    LEFT JOIN usuarios u ON c.id_usuario_creador = u.id
    LEFT JOIN clase_profesor cp ON c.id = cp.id_clase AND cp.id_usuario = $id_usuario
    LEFT JOIN usuarios pu ON cp.id_usuario = pu.id
    WHERE (cu.id_usuario = $id_usuario OR c.id_usuario_creador = $id_usuario)
    AND cu.estado = 'archivada'
";

$resultArchivada = mysqli_query($link, $sqlArchivada);
if (!$resultArchivada) {
    echo "Fallo consulta: " . mysqli_error($link);
    exit();
}

$clases = array();
while ($row = mysqli_fetch_assoc($resultActivas)) {
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
            'fondo' => $row['fondo'],
            'horarios' => []
        ];
    }

    $clases[$clase_id]['horarios'][] = [
        'dia_semana' => $row['dia_semana'],
        'hora_inicio' => $row['hora_inicio'],
        'hora_fin' => $row['hora_fin']
    ];
}

// Verificar los datos obtenidos


require_once "views/layout.php";
?>
