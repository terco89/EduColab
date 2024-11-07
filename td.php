<?php
$directorio = 'imagenes/';
$ruta_completa = $file = 'img/entregas/'.$_GET["tid"]."/".$_GET["nom"];

if (file_exists($ruta_completa)) {
    header('Content-Type: image/jpeg');
    readfile($ruta_completa);
} else {
    header("HTTP/1.0 404 Not Found");
    echo "Imagen no encontrada.";
}
?>
