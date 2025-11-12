<?php

namespace MyApi\Backend;

require_once __DIR__ . '/myapi/Products.php';

/*
header('Content-Type: application/json');
header('Content-Type: application/json');

$image_dir = '../img/';
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
*/

$products = new Products('nombre_de_tu_bd', 'usuario_bd', 'password_bd'); // Replace with actual DB credentials
// Since there's no direct method for images, we'll use list() and assume it can handle it or return a placeholder
$products->list(); // Or a more specific method if it existed, e.g., $products->getImages();
echo $products->getData();

?>