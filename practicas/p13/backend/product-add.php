<?php
use TecWeb\MyApi\Create\Create;
require_once __DIR__ . '/vendor/autoload.php';

$products = new Create('marketzone');
echo $products->add(file_get_contents('php://input'));
?>