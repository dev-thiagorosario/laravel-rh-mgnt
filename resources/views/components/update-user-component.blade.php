@php($formAction = $submitUrl !== '#' ? $submitUrl : route('users.update'))

<div
    class="modal fade update-user-modal"
    id="{{ $modalId }}"
    tabindex="-1"
    aria-labelledby="{{ $modalId }}Label"
    aria-describedby="{{ $modalId }}Description"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl update-user-modal__dialog">
        <div class="modal-content update-user-modal__content border-0">
            <div class="modal-header update-user-modal__header">
                <div>
                    <p class="update-user-modal__eyebrow">Atualizacao de cadastro</p>
                    <h2 class="modal-title update-user-modal__title" id="{{ $modalId }}Label">Editar dados do usuário</h2>
                    <p class="update-user-modal__subtitle mb-0" id="{{ $modalId }}Description">
                        Revise as informações principais do perfil e ajuste apenas o que precisa ser alterado.
                    </p>
                </div>

                <button type="button" class="btn-close update-user-modal__close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <form action="{{ $formAction }}" method="POST" class="update-user-modal__form" novalidate>
                @csrf
                @method('PUT')

                <div class="modal-body update-user-modal__body">
                    <div class="update-user-modal__grid">
                        <aside class="update-user-modal__summary" aria-label="Resumo do usuário">
                            <div class="update-user-modal__summary-top">
                                <span class="update-user-modal__icon" aria-hidden="true">
                                    <i class="fa-solid fa-user-pen"></i>
                                </span>

                                <div class="update-user-modal__summary-copy">
                                    <span class="update-user-modal__badge">Dados atuais</span>
                                    <h3 class="update-user-modal__summary-title">{{ $userName }}</h3>
                                    <p class="update-user-modal__summary-email">{{ $userEmail }}</p>
                                </div>
                            </div>

                            @if ($userRole !== '' || $userDepartment !== '' || $createdAt !== '')
                                <dl class="update-user-modal__meta">
                                    @if ($userRole !== '')
                                        <div class="update-user-modal__meta-item">
                                            <dt>Perfil</dt>
                                            <dd>{{ $userRole }}</dd>
                                        </div>
                                    @endif

                                    @if ($userDepartment !== '')
                                        <div class="update-user-modal__meta-item">
                                            <dt>Departamento</dt>
                                            <dd>{{ $userDepartment }}</dd>
                                        </div>
                                    @endif

                                    @if ($createdAt !== '')
                                        <div class="update-user-modal__meta-item">
                                            <dt>Membro desde</dt>
                                            <dd>{{ $createdAt }}</dd>
                                        </div>
                                    @endif
                                </dl>
                            @endif

                            <div class="update-user-modal__tips">
                                <p class="update-user-modal__tips-title">Antes de salvar</p>
                                <ul class="update-user-modal__tips-list">
                                    <li>Revise o nome exatamente como ele deve aparecer no perfil.</li>
                                    <li>Confirme que o e-mail continua válido para acesso e comunicação.</li>
                                </ul>
                            </div>
                        </aside>

                        <div class="update-user-modal__fields">
                            <div class="update-user-modal__section">
                                <h3 class="update-user-modal__section-title">Dados editáveis</h3>
                                <p class="update-user-modal__section-copy">
                                    Mantenha os campos atualizados para refletir as informações exibidas no sistema.
                                </p>
                            </div>

                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="{{ $modalId }}Name" class="form-label update-user-modal__label">Nome completo</label>
                                    <input
                                        type="text"
                                        name="name"
                                        id="{{ $modalId }}Name"
                                        value="{{ old('name', $userName) }}"
                                        class="form-control update-user-modal__input @error('name') is-invalid @enderror"
                                        minlength="3"
                                        maxlength="255"
                                        autocomplete="name"
                                        required
                                    >
                                    <p class="update-user-modal__hint">Use o nome que deve aparecer em listagens, cabeçalho e perfil.</p>
                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="{{ $modalId }}Email" class="form-label update-user-modal__label">E-mail</label>
                                    <input
                                        type="email"
                                        name="email"
                                        id="{{ $modalId }}Email"
                                        value="{{ old('email', $userEmail) }}"
                                        class="form-control update-user-modal__input @error('email') is-invalid @enderror"
                                        maxlength="255"
                                        autocomplete="email"
                                        required
                                    >
                                    <p class="update-user-modal__hint">Esse endereço pode ser usado como identificador de acesso do usuário.</p>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer update-user-modal__footer">
                    <p class="update-user-modal__footer-copy mb-0">
                        Campos obrigatórios: nome e e-mail.
                    </p>

                    <div class="update-user-modal__actions">
                        <button type="button" class="btn update-user-modal__cancel" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn update-user-modal__submit">
                            Salvar alterações
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
