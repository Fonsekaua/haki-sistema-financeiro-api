<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Produto;

final class ProdutoService
{
    public function listarTodos(): array
    {
        $produtos = Produto::consulta()->selecionar()->obter();
        return $produtos;
    }
    public function criar(array $dados): Produto
    {
        $produto = Produto::criar($dados);

        return $produto;
    }

    public function mostrar(int $id): ?Produto
    {
        $produto = Produto::buscar($id);

        return $produto;
    }

    public function atualizar(Produto $produto, array $dados): Produto
    {
        $produto->categoria_id = $dados['categoria_id'] ?? $produto->categoria_id;
        $produto->nome = $dados['nome'] ?? $produto->nome;
        $produto->descricao = $dados['descricao'] ?? $produto->descricao;
        $produto->preco = $dados['preco'] ?? $produto->preco;
        $produto->estoque = $dados['estoque'] ?? $produto->estoque;
        $produto->ativo = $dados['ativo'] ?? $produto->ativo;

        $produto->salvar();

        return $produto;
    }

    public function deletar(Produto $produto): void
    {
        $produto->excluir();
    }
}
