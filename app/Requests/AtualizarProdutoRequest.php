<?php

declare(strict_types=1);

namespace App\Requests;

use Haki\Validation\FormRequest;
use Haki\Validation\Rule;

final class AtualizarProdutoRequest extends FormRequest
{
    public function rules(Rule $rule): array
    {
        return [
            'categoria_id' => $rule->integer()->optional(),
            'nome' => $rule->text()->length(3, 80)->optional(),
            'descricao' => $rule->text()->optional(),
            'preco' => $rule->number()->min(0)->optional(),
            'estoque' => $rule->integer()->min(0)->optional(),
            'ativo' => $rule->boolean()->optional()
        ];
    }
}
