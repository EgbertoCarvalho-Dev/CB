<?php

use App\Controllers\Pages;
use Slim\Routing\RouteCollectorProxy;

// Todas as rotas do sistema, estarão listadas neste arquivo.



//Página de LOGIN e seus POSTS
$app->get('/', Pages::class . ":startPage");
$app->post('/', Pages::class . ":doLogin");
$app->get('/logout', Pages::class . ":doLogout");


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
$app->group('/usuarios', function (RouteCollectorProxy $group) {
    $group->get('[/]', Pages::class . ":usuario");
    $group->post('/add', Pages::class . ":saveUser");
    $group->post('/get', Pages::class . ":getUser");
    $group->post('/edit', Pages::class . ":editUser");
    $group->get('/delete/{ id }', Pages::class . ":deleteUser");
});
// Rota dos usuários e seus POSTS
$app->group('/lancamentos', function (RouteCollectorProxy $group) {
    $group->get('[/]', Pages::class . ":lancamento");
    $group->post('/add', Pages::class . ":saveEntry");
    $group->post('/get', Pages::class . ":getEntry");
    $group->post('/edit', Pages::class . ":editEntry");
    $group->get('/print/{ id }', Pages::class . ":printDocument");
    $group->get('/delete/{ id }', Pages::class . ":deleteEntry");
});
