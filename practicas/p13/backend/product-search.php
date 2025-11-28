<?php
use TecWeb\MyApi\Read\Read;
require_once __DIR__ . '/vendor/autoload.php';

$products = new Read('marketzone');
echo $products->search($_GET['search']);
?>