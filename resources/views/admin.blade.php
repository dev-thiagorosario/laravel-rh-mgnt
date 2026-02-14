<div>
    <h3>Dados do Admin:</h3>
    <p>Nome: {{ $admin->getName() }}</p>
    <p>Email: {{ $admin->getEmail() }}</p>
    <p>Perfil: {{ $admin->getRole() }}</p>
    <p>Permissões</p>
    @php
        $permissions = json_decode($admin->getPermissions() ?? '[]', true) ?? [];
        $detail = $admin->getDetail();
        $department = $admin->getDepartment();
    @endphp
    <ul>
        @foreach($permissions as $permission)
            <li>{{ $permission }}</li>
        @endforeach
    </ul>
    <h3>Detalhes</h3>
    <p>Endereço: {{ $detail?->getAddress() }}</p>
    <p>Zip Code: {{ $detail?->getZipCode() }}</p>
    <p>Cidade: {{ $detail?->getCity() }}</p>
    <p>Telefone: {{ $detail?->getPhone() }}</p>
    <p>Salário: {{ $detail?->getSalary() }} €</p>
    <p>Data de Admissão: {{ $detail?->getAdmissionDate() }}</p>
    <h3>Departamento</h3>
    <p>{{ $department?->getName() }}</p>
</div>
