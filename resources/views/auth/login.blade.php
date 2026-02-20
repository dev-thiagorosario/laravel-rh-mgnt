<x-layout-guest page-title="Login">
    <main class="login-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-9 col-xl-8">
                    <section class="login-card">
                        <div class="row g-0">
                            <aside class="col-lg-5 login-card__brand">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo RH" class="login-card__logo">
                                <h1 class="login-card__title">RH Management</h1>
                                <p class="login-card__subtitle">
                                    Faça login para acessar o painel administrativo e gerenciar colaboradores.
                                </p>
                            </aside>
                            <div class="col-lg-7">
                                <div class="login-card__content">
                                    <h2 class="login-form__heading">Entrar</h2>
                                    <p class="login-form__intro">Use seu e-mail ou usuario e senha para continuar.</p>

                                    @if ($errors->any())
                                        <div class="alert alert-danger login-alert" role="alert">
                                            Verifique os dados informados e tente novamente.
                                        </div>
                                    @endif

                                    <form action="{{ route('login.authenticate') }}" method="POST" class="login-form">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="email" class="form-label login-label">Email ou usuario</label>
                                            <input
                                                type="text"
                                                name="email"
                                                id="email"
                                                value="{{ old('email') }}"
                                                placeholder="Digite seu email ou usuario"
                                                class="form-control login-input @error('email') is-invalid @enderror"
                                                autocomplete="username"
                                                autofocus
                                                required
                                            >
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="password" class="form-label login-label">Senha</label>
                                            <input
                                                type="password"
                                                name="password"
                                                id="password"
                                                placeholder="Digite sua senha"
                                                class="form-control login-input @error('password') is-invalid @enderror"
                                                autocomplete="current-password"
                                                required
                                            >
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn login-submit w-100">Entrar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>
</x-layout-guest>
