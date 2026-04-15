<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDepartmentRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:30', 'regex:/^[\p{L}\' -]+$/u'],
            'description' => ['required', 'string', 'min:3', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome deve ser preenchido',
            'name.string' => 'O campo nome deve ser um texto valido',
            'name.min' => 'O campo nome deve ter no minimo 3 caracteres',
            'name.max' => 'O campo nome deve ter no maximo 30 caracteres',
            'name.regex' => 'O campo nome deve conter apenas letras, espaços, apóstrofo ou hífen',

            'description.required' => 'O campo descrição deve ser preenchido',
            'description.string' => 'O campo descrição deve ser um texto valido',
            'description.min' => 'O campo descrição deve ter no minimo 3 caracteres',
            'description.max' => 'O campo descrição deve ter no maximo 255 caracteres',
        ];
    }

    public function authorize(): bool
    {
        return $this->user() !== null;
    }
}
