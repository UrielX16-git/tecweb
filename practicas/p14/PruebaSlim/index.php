<?php
require 'vendor/autoload.php';

$app = new \Slim\App;

$app->get('/', function ($request, $response, $args) {
    $response->write('Hola mundo Slim');
    return $response;
});

$app->get('/Hola/{nombre}', function ($request, $response, $args) {
    $response->write('Hola ' . $args['nombre']);
    return $response;
});

$app->run();
