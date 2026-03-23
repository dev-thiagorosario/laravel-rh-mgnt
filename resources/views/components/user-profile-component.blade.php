<section class="card shadow-sm border-0">
    <div class="card-body p-4 p-lg-5">
        <p class="text-uppercase text-muted fw-semibold mb-2">Perfil</p>
        <h1 class="h2 mb-4">Dados do usuário</h1>

        <dl class="row g-4 mb-0">
            <div class="col-12 col-md-6">
                <dt class="small text-uppercase text-muted mb-2">
                    <i class="fa-solid fa-user me-2" aria-hidden="true"></i>
                    Nome
                </dt>
                <dd class="fs-5 mb-0">{{ $userName }}</dd>
            </div>

            <div class="col-12 col-md-6">
                <dt class="small text-uppercase text-muted mb-2">
                    <i class="fa-solid fa-envelope me-2" aria-hidden="true"></i>
                    E-mail
                </dt>
                <dd class="fs-5 mb-0">{{ $userEmail }}</dd>
            </div>

            <div class="col-12 col-md-6">
                <dt class="small text-uppercase text-muted mb-2">
                    <i class="fa-solid fa-user-tag me-2" aria-hidden="true"></i>
                    Perfil
                </dt>
                <dd class="fs-5 mb-0 text-capitalize">{{ $userRole }}</dd>
            </div>

            <div class="col-12 col-md-6">
                <dt class="small text-uppercase text-muted mb-2">
                    <i class="fa-solid fa-building me-2" aria-hidden="true"></i>
                    Departamento
                </dt>
                <dd class="fs-5 mb-0">{{ $userDepartment }}</dd>
            </div>

            <div class="col-12 col-md-6">
                <dt class="small text-uppercase text-muted mb-2">
                    <i class="fa-solid fa-calendar me-2" aria-hidden="true"></i>
                    Membro desde
                </dt>
                <dd class="fs-5 mb-0">{{ $createdAt }}</dd>
            </div>
        </dl>
    </div>
</section>
