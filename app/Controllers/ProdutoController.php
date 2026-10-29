<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Requests\AtualizarProdutoRequest;
use App\Requests\CriarProdutoRequest;
use App\Services\ProdutoService;
use Haki\Http\Response;

final class ProdutoController
{
    public function __construct(private readonly ProdutoService $service) {}

    public function listarTodos(Response $res): Response
    {
        $produtos = $this->service->listarTodos();

        if (count($produtos) === 0) {
            return $res->json([
                'status' => false,
                'mensagem' => "nenhum produto cadastrado!",
                'resposta' => []
            ]);
        }

        return $res->json([
            'status' => true,
            'mensagem' => "Produtos encontrados com sucesso!",
            'resposta' => $produtos
        ]);
    }

    public function criar(CriarProdutoRequest $req, Response $res): Response
    {
        $data = $req->validated();

        if (!$data) {
            return $res->json([
                'status' => false,
                'mensagem' => 'Ocorreu um erro na validação dos dados!',
                'resposta' => null
            ], 400);
        }
        $produto = $this->service->criar($data);

        return $res->json([
            'status' => true,
            'mensagem' => 'Produto criado com sucesso!',
            'resposta' => $produto
        ]);
    }

    public function mostrar(int $id, Response $res): Response
    {
        $produto = $this->service->mostrar($id);

        if ($produto === null) {
            return $res->json([
                'status' => false,
                'mensagem' => 'Produto não encontrado!',
                'resposta' => null
            ]);
        }

        return $res->json([
            'status' => true,
            'mensagem' => 'Produto encontrado!',
            'resposta' => $produto
        ]);
    }

    public function atualizar(int $id, AtualizarProdutoRequest $req, Response $res): Response
    {
        $produto = $this->service->mostrar($id);

        if ($produto === null) {
            return $res->json([
                'status' => false,
                'mensagem' => 'Produto não encontrado!',
                'resposta' => null
            ]);
        }
        $data = $req->validated();

        if (!$data) {
            return $res->json([
                'status' => false,
                'mensagem' => 'Ocorreu um erro na validação dos dados!',
                'resposta' => null
            ], 400);
        }
        $produtoAtt = $this->service->atualizar($produto, $data);

        return $res->json([
            'status' => true,
            'mensagem' => 'Produto atualizado com sucesso!',
            'resposta' => $produtoAtt
        ]);
    }

        public function deletar(int $id, Response $res): Response
    {
        $produto = $this->service->mostrar($id);

        if ($produto == null) {
            return $res->json([
                'status' => false,
                'mensagem' => 'Este produto não existe!!',
            ]);
        }
        
        $this->service->deletar($produto);

        return $res->json([
            'status' => true,
            'mensagem' => 'Produto deletada com sucesso!'
        ]);
    }
}
