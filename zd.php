<?php
// archivo: serve_pdf.php

$file = 'img/entregas/'.$_GET["tid"]."/".$_GET["nom"]; // Ruta al archivo PDF

// Verifica si el archivo existe
if (file_exists($file)) {
    // Establece el tipo de contenido a PDF
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . basename($file) . '"');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize($file));
    header('Cache-Control: private, max-age=0, must-revalidate');
    header('Cache-Control: public, must-revalidate, proxy-revalidate');
    header('Pragma: public');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Fecha pasada
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    
    // Lee el archivo PDF
    readfile($file);
    exit;
} else {
    echo "Archivo no encontrado.";
}
?>