<?php

declare(strict_types=1);

namespace App\View\Models;

final class DepartamentListViewModel
{
    /**
     * @var list<array{id: int, name: string, description: string}>|null
     */
    private ?array $normalizedDepartaments = null;

    /**
     * @param list<array<string, mixed>> $departaments
     */
    public function __construct(
        private readonly array $departaments = [],
        private readonly ?string $errorMessage = null,
    ) {
    }

    /**
     * @return list<array{id: int, name: string, description: string}>
     */
    public function departaments(): array
    {
        if ($this->normalizedDepartaments === null) {
            $this->normalizedDepartaments = array_values(array_map(
                fn (array $departament): array => $this->normalizeDepartament($departament),
                array_filter($this->departaments, 'is_array')
            ));
        }

        return $this->normalizedDepartaments;
    }

    public function hasDepartaments(): bool
    {
        return count($this->departaments()) > 0;
    }

    public function statusMessage(): ?string
    {
        if ($this->errorMessage !== null) {
            return $this->errorMessage;
        }

        if (! $this->hasDepartaments()) {
            return 'Nenhum departamento cadastrado ate o momento.';
        }

        return null;
    }

    public function statusVariant(): string
    {
        if ($this->errorMessage !== null) {
            return 'danger';
        }

        if (! $this->hasDepartaments()) {
            return 'info';
        }

        return 'secondary';
    }

    /**
     * @param array<string, mixed> $departament
     * @return array{id: int, name: string, description: string}
     */
    private function normalizeDepartament(array $departament): array
    {
        $name = trim((string) ($departament['name'] ?? ''));
        $description = trim((string) ($departament['description'] ?? ''));

        return [
            'id' => (int) ($departament['id'] ?? 0),
            'name' => $name !== '' ? $name : 'Sem nome',
            'description' => $description !== '' ? $description : 'Sem descricao cadastrada',
        ];
    }
}
