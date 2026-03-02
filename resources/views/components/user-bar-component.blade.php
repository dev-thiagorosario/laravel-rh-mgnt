<header class="user-bar">
    @php
        $dashboardRoute = \Illuminate\Support\Facades\Route::has('dashboard') ? route('dashboard') : '#';
    @endphp

    <div class="user-bar__brand">
        <a href="{{ $dashboardRoute }}" class="user-bar__logo-link" aria-label="Ir para dashboard">
            <img src="{{ asset('assets/images/favicon.png') }}" alt="Logo RH" class="user-bar__logo">
        </a>
        <div class="user-bar__brand-copy">
            <p class="user-bar__product">{{ config('app.name') }}</p>
            <small class="user-bar__tagline">Painel Administrativo</small>
        </div>
    </div>

    <div class="user-bar__account">
        <span class="user-bar__avatar" aria-hidden="true">
            <i class="fas fa-user"></i>
        </span>

        <div class="user-bar__meta">
            <p class="user-bar__name">{{ $name }}</p>
            <small class="user-bar__department">{{ $department }}</small>
        </div>

        <form action="{{ route('logout') }}" method="post" class="user-bar__logout-form">
            @csrf
            <button type="submit" class="user-bar__logout-btn" aria-label="Sair da conta">
                <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                <span class="user-bar__logout-text">Sair</span>
            </button>
        </form>
    </div>
</header>
