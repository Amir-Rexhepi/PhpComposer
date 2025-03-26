<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controllers/HelloController.php';
require __DIR__ . '/controllers/AlunniController.php';
$app = AppFactory::create();

//$app->get('/hello',"HelloController:hello");
//$app->get('/hello/{name}',"HelloController:hello_with_name");
//$app->get('/json/{name}', "HelloController:json");

$app->get('/alunni',"AlunniController:index");
$app->get('/alunni/{id}',"AlunniController:view");
$app->post('/alunni', "AlunniController:create");
$app->delete('/alunni/{id}', "AlunniController:delete");
$app->put('/alunni/{id}', "AlunniController:update"); 
$app->run();

// // curl -X POST localhost:8080/alunni --data '{"nome":"Amir","cognome":"Rexhepi"}' -H "Content-Type, application/json"
// curl -X DELETE http://localhost:8080/alunni/5