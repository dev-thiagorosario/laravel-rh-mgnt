<?php

declare(strict_types=1);

namespace App\View\Components;

use App\View\Http\BackendApiClient;
use App\View\Models\SideBarViewModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;
use Throwable;

final class SideBarComponent extends Component
{
    private SideBarViewModel $vm;

    public function __construct(
        Request $request,
        BackendApiClient $backendApiClient,
    ) {
        $this->vm = new SideBarViewModel(
            menuItems: $this->menuItemsFromBackend($request, $backendApiClient),
        );
    }

    public function menuItems(): array
    {
        return $this->vm->menuItems();
    }

    public function render(): View|Closure|string
    {
        return view('components.side-bar-component', [
            'menuItems' => $this->menuItems(),
        ]);
    }

    private function menuItemsFromBackend(Request $request, BackendApiClient $backendApiClient): array
    {
        try {
            $response = $backendApiClient->get($request, 'sidebar.menu');
            $data = $response->json('data');

            if ($response->successful() && is_array($data)) {
                return array_values(array_filter($data, 'is_array'));
            }
        } catch (Throwable) {
        }

        return [];
    }
}
