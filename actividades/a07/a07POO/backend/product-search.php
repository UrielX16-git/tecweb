<?php
use MyApi\Products;
require_once __DIR__.'/myapi/Products.php';

$search = $_GET['search'] ?? null;

$productos = new Products('marketzone', 'root', '161202');
$productos->search($search);
echo $productos->getData();
?>