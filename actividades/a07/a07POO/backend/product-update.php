<?php
use MyApi\Products;
require_once __DIR__.'/myapi/Products.php';

$productoJson = file_get_contents('php://input');

$productos = new Products('marketzone', 'root', '161202');
$productos->edit($productoJson);
echo $productos->getData();
?>