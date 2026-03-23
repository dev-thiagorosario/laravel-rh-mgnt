<x-layout-guest page-title="Dashboard">
    <section class="card shadow-sm border-0">
        <div class="card-body p-4 p-lg-5">
            <p class="text-uppercase text-muted fw-semibold mb-2">Painel RH</p>
            <h1 class="h2 mb-3">Visão geral</h1>
            <p class="text-secondary mb-4">
                Centralize acessos rápidos para as áreas disponíveis e acompanhe as tarefas administrativas do dia.
            </p>

            <div class="d-flex flex-wrap gap-3">
                <a href="{{ route('user.profile') }}" class="btn btn-primary">
                    Ver meu perfil
                </a>

                @if(auth()->user()?->role !== 'employee' && \Illuminate\Support\Facades\Route::has('users.create'))
                    <a href="{{ route('users.create') }}" class="btn btn-outline-secondary">
                        Adicionar colaborador
                    </a>
                @endif
            </div>
        </div>
    </section>
</x-layout-guest>
