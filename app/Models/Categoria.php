<?php
namespace App\Models;
use Elo\Modelo;

final class Categoria extends Modelo {
      protected array $temMuitos = [
        'produtos' => Produto::class
      ];
}

?>