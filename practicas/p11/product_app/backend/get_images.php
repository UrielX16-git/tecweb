<?php
header('Content-Type: application/json');

$scan_dir = '../../img/';
$html_path_prefix = '../img/';
$images = [];

if (is_dir($scan_dir)) {
    if ($dh = opendir($scan_dir)) {
        while (($file = readdir($dh)) !== false) {
            if (is_file($scan_dir . $file) && preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)) {
                $images[] = $html_path_prefix . $file;
            }
        }
        closedir($dh);
    }
}

echo json_encode($images);
?>