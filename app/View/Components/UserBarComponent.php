<?php

declare(strict_types=1);

namespace App\View\Components;

use App\View\Http\BackendApiClient;
use App\View\Models\UserBarViewModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;
use Throwable;

final class UserBarComponent extends Component
{
    public string $name;
    public string $department;

    public function __construct(
        Request $request,
        BackendApiClient $backendApiClient,
    ) {
        $userData = $this->authenticatedUserData($request, $backendApiClient);
        $vm = new UserBarViewModel(
            name: $userData['name'],
            department: $userData['department'],
        );

        $this->name = $vm->name();
        $this->department = $vm->department();
    }

    public function render(): View|Closure|string
    {
        return view('components.user-bar-component');
    }

    private function authenticatedUserData(Request $request, BackendApiClient $backendApiClient): array
    {
        try {
            $response = $backendApiClient->get($request, 'authenticated-user.view-data');
            $data = $response->json('data');

            if ($response->successful() && is_array($data)) {
                return $data;
            }
        } catch (Throwable) {
        }

        return [
            'name' => 'Usuario',
            'department' => 'Sem departamento',
        ];
    }
}
