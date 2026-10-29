<?php

declare(strict_types=1);

namespace App\Requests;

use Haki\Validation\FormRequest;
use Haki\Validation\Rule;

final class CriarProdutoRequest extends FormRequest
{
    public function rules(Rule $rule): array
    {
        return [
            'categoria_id' => $rule->integer(),
            'nome' => $rule->text()->length(3, 80),
            'descricao' => $rule->text()->optional(null),
            'preco' => $rule->number()->min(0),
            'estoque' => $rule->integer()->min(0),
            'ativo' => $rule->boolean()->optional(true)
        ];
    }
}
