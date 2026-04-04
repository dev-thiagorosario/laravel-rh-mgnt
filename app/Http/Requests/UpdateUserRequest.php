<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $email = $this->input('email');
        if ($email) {
            $this->merge(['email' => strtolower($email)]);
        }

        $name = $this->input('name');
        if ($name) {
            $this->merge(['name' => ucfirst($name)]);
        }
    }

    public function rules(): array
    {
        return [
            'email' => 'email|unique:users,email,{$this->user->id}',
            'name' => 'string|min:3|max:255|regex:/^[\\p{L}\' -]+$/u',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'email.required' => 'O campo email  deve ser preenchido',
            'email.string' => 'O campo email  deve ser um texto valido',
            'email.unique' => 'O email informado ja esta em uso',
            'name.required' => 'O campo nome deve ser preenchido',
            'name.string' => 'O campo nome deve ser um texto valido',
        ];
    }
}
