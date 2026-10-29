<?php 

use Elo\Tabela;
use Elo\Coluna;
use Elo\Migracao;

return new class extends Migracao {
    #[Override]
    public function subir(): void
    {
        Tabela::criar('categorias', [
            'nome' => Coluna::texto(80)->unico(),
            'descricao' => Coluna::textoLongo()->nulo()
        ]);
    }

    #[Override]
    public function descer(): void
    {
        Tabela::apagar('categorias');
    }
}

?>