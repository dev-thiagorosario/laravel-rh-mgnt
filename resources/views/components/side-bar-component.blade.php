<aside class="sidebar" aria-label="Menu principal">
    <div class="sidebar__header">
        <p class="sidebar__eyebrow">Navegacao</p>
        <h2 class="sidebar__title">Painel RH</h2>
    </div>

    <p class="sidebar__caption">Atalhos</p>

    <nav class="sidebar__nav">
        @foreach($menuItems as $item)
            @php
                $targetPath = trim((string) parse_url($item['route'], PHP_URL_PATH), '/');
                $currentPath = trim(request()->path(), '/');
                $iconClass = trim(str_replace('me-3', '', $item['icon']));
                $isAvailable = $item['is_available'] ?? false;
                $isActive = $isAvailable
                    && ($currentPath === $targetPath || request()->url() === $item['route']);
            @endphp

            @if($isAvailable)
                <a
                    href="{{ $item['route'] }}"
                    class="sidebar__link {{ $isActive ? 'sidebar__link--active' : '' }}"
                    @if($isActive) aria-current="page" @endif
                >
                    <i class="{{ $iconClass }} sidebar__link-icon" aria-hidden="true"></i>
                    <span>{{ $item['title'] }}</span>
                </a>
            @else
                <span
                    class="sidebar__link sidebar__link--disabled"
                    aria-disabled="true"
                    title="Rota ainda não disponível"
                >
                    <i class="{{ $iconClass }} sidebar__link-icon" aria-hidden="true"></i>
                    <span>{{ $item['title'] }}</span>
                </span>
            @endif
        @endforeach
    </nav>
</aside>
