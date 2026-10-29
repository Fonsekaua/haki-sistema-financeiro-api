<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Requests\CriarCategoriaRequest;
use Haki\Http\Request;
use Haki\Http\Response;
use App\Services\CategoriaService;

final class CategoriaController
{
    public function __construct(private readonly CategoriaService $service) {}

    public function criar(CriarCategoriaRequest $req, Response $res): Response
    {
        $service = $this->service;
        $data = $req->validated();

        if (!$data) {
            return $res->json([
                'status' => false,
                'mensagem' => 'Ocorreu um erro na validação dos dados!',
                'resposta' => null
            ],400);
        }

        $categoria = $service->criar($data);


        return $res->json([
            'status' => true,
            'mensagem' => 'Categoria criada com sucesso!',
            'resposta' => $categoria

        ]);
    }
    public function listarTodos(Response $res): Response
    {
        $categorias = $this->service->listarTodos();
        if (count($categorias) == 0) {
            return $res->json([
                'status' => true,
                'resposta' => []
            ]);
        }
        return $res->json([
            'status' => true,
            'resposta' => $categorias
        ]);
    }

    public function mostrar(int $id, Response $res): Response
    {
        $service = $this->service;

        $categoria = $service->mostrar($id);

        if ($categoria == null) {
            return $res->json([
                'status' => false,
                'mensagem' => 'Não foi encontrado nenhuma categoria!',
                'resposta' => null
            ]);
        }

        return $res->json([
            'status' => true,
            'mensagem' => 'Categoria encontrada!',
            'resposta' => $categoria
        ]);
    }

    public function listarProdutosDaCategoria(int $id, Response $res): Response
    {
        $listaProdutos = $this->service->listarProdutosDaCategoria($id);
        $categoria = $this->service->mostrar($id);

        if ($categoria == null) {
            return $res->json([
                'status' => false,
                'mensagem' => 'Está categoria não existe!!',
                'resposta' => null
            ]);
        }
        if (count($listaProdutos) == 0) {
            return $res->json([
                'status' => false,
                'mensagem' => 'nenhum produto pertencente a esta categoria!',
                'resposta' => []
            ]);
        }

        return $res->json([
            'status' => true,
            'mensagem' => 'produtos encontrados com sucesso!',
            'resposta' => $listaProdutos
        ]);
    }

    public function deletar(int $id, Response $res): Response
    {
        $categoria = $this->service->mostrar($id);

        if ($categoria == null) {
            return $res->json([
                'status' => false,
                'mensagem' => 'Está categoria não existe!!',
            ]);
        }
        
        $this->service->deletar($categoria);

        return $res->json([
            'status' => true,
            'mensagem' => 'Categoria deletada com sucesso!'
        ]);
    }
}
