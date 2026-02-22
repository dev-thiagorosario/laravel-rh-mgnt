<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'O campo user_id e obrigatorio.',
            'user_id.integer' => 'O campo user_id deve ser um numero inteiro.',
            'user_id.exists' => 'Usuario nao encontrado para o user_id informado.',
        ];
    }
}
