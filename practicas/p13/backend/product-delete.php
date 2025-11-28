<?php
use TecWeb\MyApi\Delete\Delete;
require_once __DIR__ . '/vendor/autoload.php';

$products = new Delete('marketzone');
echo $products->delete($_GET['id']);
?>