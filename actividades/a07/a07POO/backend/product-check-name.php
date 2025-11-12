<?php
use MyApi\Products;
require_once __DIR__.'/myapi/Products.php';

$nombre = $_GET['nombre'] ?? null;

$productos = new Products('marketzone', 'root', '161202');
$productos->checkName($nombre); 
echo $productos->getData();
?>