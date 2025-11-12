<?php
use MyApi\Products;
require_once __DIR__.'/myapi/Products.php';

$id = $_GET['id'] ?? null;

$productos = new Products('marketzone', 'root', '161202');
$productos->delete($id);
echo $productos->getData();
?>