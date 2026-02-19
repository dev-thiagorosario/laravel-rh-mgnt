<section class="create-user-page">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">
                <div class="create-user-card">
                    <div class="row g-0">
                        <aside class="col-lg-4 create-user-card__aside">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo RH" class="create-user-card__logo">
                            <h1 class="create-user-card__title">Novo Usuario</h1>
                            <p class="create-user-card__subtitle">
                                Cadastre colaboradores com perfil, departamento e permissoes de acesso.
                            </p>
                            <ul class="create-user-card__tips">
                                <li>Preencha email valido e unico.</li>
                                <li>Senha com no minimo 8 caracteres.</li>
                                <li>Defina permissoes conforme o perfil.</li>
                            </ul>
                        </aside>

                        <div class="col-lg-8">
                            <div class="create-user-card__content">
                                <h2 class="create-user-form__heading">Criacao de Usuario</h2>
                                <p class="create-user-form__intro">
                                    Os campos abaixo sao obrigatorios para concluir o cadastro.
                                </p>

                                @if (session('success'))
                                    <div class="alert alert-success create-user-alert" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if ($errors->has('general'))
                                    <div class="alert alert-danger create-user-alert" role="alert">
                                        {{ $errors->first('general') }}
                                    </div>
                                @elseif ($errors->any())
                                    <div class="alert alert-danger create-user-alert" role="alert">
                                        Verifique os campos e tente novamente.
                                    </div>
                                @endif

                                <form action="{{ $submitUrl }}" method="POST" class="create-user-form">
                                    @csrf

                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="name" class="form-label create-user-label">Nome</label>
                                            <input
                                                type="text"
                                                id="name"
                                                name="name"
                                                value="{{ old('name') }}"
                                                class="form-control create-user-input @error('name') is-invalid @enderror"
                                                minlength="3"
                                                maxlength="255"
                                                autocomplete="name"
                                                required
                                            >
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label for="email" class="form-label create-user-label">Email</label>
                                            <input
                                                type="email"
                                                id="email"
                                                name="email"
                                                value="{{ old('email') }}"
                                                class="form-control create-user-input @error('email') is-invalid @enderror"
                                                maxlength="255"
                                                autocomplete="email"
                                                required
                                            >
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label for="password" class="form-label create-user-label">Senha</label>
                                            <input
                                                type="password"
                                                id="password"
                                                name="password"
                                                class="form-control create-user-input @error('password') is-invalid @enderror"
                                                minlength="8"
                                                autocomplete="new-password"
                                                required
                                            >
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label for="password_confirmation" class="form-label create-user-label">Confirmacao da senha</label>
                                            <input
                                                type="password"
                                                id="password_confirmation"
                                                name="password_confirmation"
                                                class="form-control create-user-input @error('password_confirmation') is-invalid @enderror"
                                                minlength="8"
                                                autocomplete="new-password"
                                                required
                                            >
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label for="departament_id" class="form-label create-user-label">Departamento</label>
                                            <select
                                                id="departament_id"
                                                name="departament_id"
                                                class="form-select create-user-select @error('departament_id') is-invalid @enderror"
                                                required
                                            >
                                                <option value="" disabled @selected(old('departament_id') === null)>Selecione</option>
                                                @foreach($departments as $department)
                                                    <option
                                                        value="{{ $department['id'] }}"
                                                        @selected((string) old('departament_id') === (string) $department['id'])
                                                    >
                                                        {{ $department['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('departament_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label for="role" class="form-label create-user-label">Perfil</label>
                                            <select
                                                id="role"
                                                name="role"
                                                class="form-select create-user-select @error('role') is-invalid @enderror"
                                                required
                                            >
                                                <option value="" disabled @selected(old('role') === null)>Selecione</option>
                                                @foreach($roles as $role)
                                                    <option
                                                        value="{{ $role['value'] }}"
                                                        @selected(old('role') === $role['value'])
                                                    >
                                                        {{ $role['label'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label for="permissions" class="form-label create-user-label">Permissoes</label>
                                            @php
                                                $selectedPermissions = old('permissions', []);
                                                $selectedPermissions = is_array($selectedPermissions) ? $selectedPermissions : [];
                                            @endphp
                                            <select
                                                id="permissions"
                                                name="permissions[]"
                                                class="form-select create-user-select create-user-select--multiple @if($errors->has('permissions') || $errors->has('permissions.*')) is-invalid @endif"
                                                multiple
                                                required
                                                size="{{ min(max(count($permissions), 3), 6) }}"
                                            >
                                                @foreach($permissions as $permission)
                                                    <option
                                                        value="{{ $permission['value'] }}"
                                                        @selected(in_array($permission['value'], $selectedPermissions, true))
                                                    >
                                                        {{ $permission['label'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('permissions'))
                                                <div class="invalid-feedback d-block">{{ $errors->first('permissions') }}</div>
                                            @elseif ($errors->has('permissions.*'))
                                                <div class="invalid-feedback d-block">{{ $errors->first('permissions.*') }}</div>
                                            @endif
                                            <small class="form-text create-user-help">
                                                Use Ctrl (ou Cmd no Mac) para selecionar mais de uma permissao.
                                            </small>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="submit" class="btn create-user-submit px-4">Salvar Usuario</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
