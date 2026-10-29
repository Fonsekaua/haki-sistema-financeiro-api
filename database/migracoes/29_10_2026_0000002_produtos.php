<?php 

use Elo\Tabela;
use Elo\Coluna;
use Elo\Migracao;

return new class extends Migracao {
    #[Override]
    public function subir(): void
    {
        Tabela::criar('produtos', [
            'categoria_id' => Coluna::pertenceA('categorias')->aoExcluir('RESTRICT')->indice(),
            'nome' => Coluna::texto(80),
            'descricao' => Coluna::textoLongo()->nulo(),
            'preco' => Coluna::decimal(10,2)->padrao(0),
            'estoque' => Coluna::inteiro()->semSinal()->padrao(0),
            'ativo' => Coluna::booleano()->padrao(true)
        ], [
            'exclusao_logica' => true
        ]);
    }

    #[Override]
    public function descer(): void
    {
        Tabela::apagar('produtos');
    }
}

?>