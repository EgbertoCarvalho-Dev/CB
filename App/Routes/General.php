<?php

use App\Controllers\Pages;
use Slim\Routing\RouteCollectorProxy;

// Todas as rotas do sistema, estarão listadas neste arquivo.



//Página de LOGIN e seus POSTS
$app->get('/', Pages::class . ":startPage");
$app->post('/', Pages::class . ":doLogin");


//Página do Dashboard e seus POSTS
$app->get('/dashboard', Pages::class . ":dashboard");


// Rota dos fornecedores e seus POSTS
$app->group('/fornecedores', function (RouteCollectorProxy $group) {
    $group->get('[/]', Pages::class . ":fornecedor");
    $group->post('/add', Pages::class . ":saveSupplier");
    $group->post('/get', Pages::class . ":getSupplier");
    $group->post('/edit', Pages::class . ":editSupplier");
    $group->get('/delete/{ id }', Pages::class . ":deleteSupplier");
});


// Rota dos veiculos e seus POSTS
$app->group('/veiculos', function (RouteCollectorProxy $group) {
    $group->get('[/]', Pages::class . ":veiculo");
    $group->post('/add', Pages::class . ":saveCar");
    $group->post('/get', Pages::class . ":getCar");
    $group->post('/edit', Pages::class . ":editCar");
    $group->get('/delete/{ id }', Pages::class . ":deleteCar");
});

// Rota dos usuários e seus POSTS
$app->get('/usuarios', Pages::class . ":usuario");

//Rota dos lançamentos e seus POSTS
$app->get('/lancamentos', Pages::class . ":lancamento");
