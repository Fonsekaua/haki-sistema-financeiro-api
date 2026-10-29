<?php
namespace App\Models;
use Elo\Modelo;

final class Produto extends Modelo {
      protected bool $exclusaoLogica = true;

      protected array $pertenceA = [
        'categoria' => Categoria::class
      ];
}

?>