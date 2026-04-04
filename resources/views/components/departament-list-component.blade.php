<section class="card shadow-sm border-0">
    <div class="card-body p-4 p-lg-5">
        <div class="d-flex flex-column flex-lg-row justify-content-lg-between align-items-lg-start gap-3 mb-4">
            <div>
                <p class="text-uppercase text-muted fw-semibold mb-2">Estrutura organizacional</p>
                <h1 class="h2 mb-2">Departamentos</h1>
            </div>

            <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary">
                Atualizar lista
            </a>
        </div>

        @if($vm->statusMessage() !== null)
            <div class="alert alert-{{ $vm->statusVariant() }} mb-4" role="status">
                {{ $vm->statusMessage() }}
            </div>
        @endif

        @if($vm->hasDepartaments())
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Descricao</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vm->departaments() as $departament)
                        <tr>
                            <td class="fw-semibold">{{ $departament['name'] }}</td>
                            <td>{{ $departament['description'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</section>
