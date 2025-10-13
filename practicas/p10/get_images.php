<?php
header('Content-Type: application/json');

$image_dir = 'img/';
$images = [];

// Escanear el directorio en busca de archivos
if (is_dir($image_dir)) {
    if ($dh = opendir($image_dir)) {
        while (($file = readdir($dh)) !== false) {
            if (is_file($image_dir . $file) && preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)) {
                $images[] = $image_dir . $file;
            }
        }
        closedir($dh);
    }
}

echo json_encode($images);
?>