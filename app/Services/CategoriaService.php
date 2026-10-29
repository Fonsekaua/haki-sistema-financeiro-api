<?php 
declare(strict_types=1);

namespace App\Services;

use App\Models\Categoria;
use App\Models\Produto;

final class CategoriaService {
    public function listarTodos(): array {
        return Categoria::selecionar()->obter();
    }

    public function criar(array $data): Categoria {
        $categoria = Categoria::criar($data);
        return $categoria;
    }

    public function mostrar(int $id) : ?Categoria {
        return Categoria::buscar($id);
    }
    
    public function listarProdutosDaCategoria(int $id): array {
        return Produto::onde('categoria_id', $id)->obter();
    }
    public function deletar(Categoria $categoria): void {
        $categoria->excluir();
    }
}
?>