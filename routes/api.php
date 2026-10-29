<?php

declare(strict_types=1);

use App\Controllers\CategoriaController;
use App\Controllers\HomeController;
use App\Controllers\ProdutoController;
use Haki\Haki;

/** @var Haki\Haki $app */

$app->get('/', [HomeController::class, 'index']);

$app->group('/categorias', function(Haki $app) {
    $app->get('/', [CategoriaController::class, 'listarTodos']);
    $app->post('/', [CategoriaController::class, 'criar']);
    $app->get('/{id}', [CategoriaController::class, 'mostrar']);
    $app->get('/{id}/produtos', [CategoriaController::class, 'listarProdutosDaCategoria']);
    $app->delete('/{id}', [CategoriaController::class, 'deletar']);

});

$app->group('/produtos', function(Haki $app) {
    $app->get('/', [ProdutoController::class, 'listarTodos']);
    $app->post('/', [ProdutoController::class, 'criar']);
    $app->get('/{id}', [ProdutoController::class, 'mostrar']);
    $app->put('/{id}', [ProdutoController::class, 'atualizar']);
    $app->delete('/{id}', [ProdutoController::class, 'deletar']);
});