<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Policies\CreateUserPolicy;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class CreateUserRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        if ($this->filled('departamento_id') && !$this->filled('departament_id')) {
            $this->merge([
                'departament_id' => $this->input('departamento_id'),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255|regex:/^[\\p{L}\' -]+$/u',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)->mixedCase()->numbers(),
            ],
            'departament_id' => 'required|integer|exists:departaments,id',
            'role' => ['required', Rule::in(['admin', 'manager', 'employee'])],
            'permissions' => ['required', 'array', 'min:1'],
            'permissions.*' => ['required', 'string', 'max:64', 'distinct'],
        ];
    }

    public function authorize(): bool
    {
        $user = $this->user();

        if ($user === null) {
            return false;
        }

        $targetDepartamentId = $this->input('departament_id');

        if ($targetDepartamentId === null) {
            return in_array($user->role, ['admin', 'manager'], true);
        }

        return app(CreateUserPolicy::class)->create($user, (int) $targetDepartamentId);
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome e obrigatorio.',
            'name.string' => 'O nome deve ser um texto valido.',
            'name.regex' => 'O nome deve conter apenas letras, espacos, apostrofo ou hifen.',
            'name.max' => 'O nome deve ter no maximo 255 caracteres.',
            'name.min' => 'O nome deve ter no minimo 3 caracteres.',

            'email.required' => 'O e-mail e obrigatorio.',
            'email.string' => 'O e-mail deve ser um texto valido.',
            'email.email' => 'Informe um e-mail valido.',
            'email.max' => 'O e-mail pode ter no maximo :max caracteres.',
            'email.unique' => 'Este e-mail ja esta em uso.',

            'password.required' => 'A senha e obrigatoria.',
            'password.string' => 'A senha deve ser um texto valido.',
            'password.confirmed' => 'A confirmacao da senha nao confere.',
            'password.min' => 'A senha deve conter no minimo :min caracteres.',
            'password.mixed_case' => 'A senha deve conter ao menos uma letra maiuscula e uma minuscula.',
            'password.numbers' => 'A senha deve conter ao menos um numero.',

            'departament_id.required' => 'O departamento e obrigatorio.',
            'departament_id.integer' => 'O departamento selecionado e invalido.',
            'departament_id.exists' => 'O departamento selecionado nao existe.',

            'role.required' => 'O perfil e obrigatorio.',
            'role.in' => 'O perfil informado e invalido.',

            'permissions.required' => 'As permissoes sao obrigatorias.',
            'permissions.array' => 'As permissoes devem ser enviadas como lista.',
            'permissions.min' => 'Selecione ao menos uma permissao.',

            'permissions.*.required' => 'Cada permissao deve ser informada.',
            'permissions.*.string' => 'Cada permissao deve ser um texto valido.',
            'permissions.*.max' => 'Cada permissao deve ter no maximo :max caracteres.',
            'permissions.*.distinct' => 'Nao repita permissoes na selecao.',
        ];
    }
}
