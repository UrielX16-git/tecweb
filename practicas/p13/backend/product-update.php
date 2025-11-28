<?php
use TecWeb\MyApi\Update\Update;
require_once __DIR__ . '/vendor/autoload.php';

$products = new Update('marketzone');
echo $products->edit(file_get_contents('php://input'));
?>