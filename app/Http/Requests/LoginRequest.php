<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    protected function prepareForValidation(): void
    {
        $login = trim((string) $this->input('email'));

        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $login = strtolower($login);
        }

        $this->merge([
            'email' => $login,
        ]);
    }

    public function rules(): array
    {
        return [
                'email' => 'required|string',
                'password' => 'required|string',
            ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'email.required' => 'O campo email ou nome de usuario deve ser preenchido',
            'email.string' => 'O campo email ou nome de usuario deve ser um texto valido',
            'password.required' => 'A senha e obrigatoria',
            'password.string' => 'A senha deve ser um texto valido',
        ];
    }
}
