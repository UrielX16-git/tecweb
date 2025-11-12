<?php
use MyApi\Products;

require_once __DIR__.'/myapi/Products.php';

$productos = new Products('marketzone', 'root', '161202');


$productos->list();


echo $productos->getData();
?>