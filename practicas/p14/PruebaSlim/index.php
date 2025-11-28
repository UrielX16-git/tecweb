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

$app->post('/prueba_post', function ($request, $response, $args) {
    $req_post = $request->getParsedBody();
    $val1 = $req_post['nombre'];
    $val2 = $req_post['apellido'];
    $response->write('Valores: ' . $val1 . ' ' . $val2);
    return $response;
});

$app->get('/test_json', function ($request, $response, $args) {
    $data[0]['nombre'] = 'Uriel';
    $data[0]['apellidos'] = 'Torres';
    $data[1]['nombre'] = 'Pablo';
    $data[1]['apellidos'] = 'Munoz';

    $response->write(json_encode($data));
    return $response;
});

$app->run();
