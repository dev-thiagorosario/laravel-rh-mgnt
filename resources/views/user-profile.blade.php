<x-layout-guest page-title="Perfil do Usuário">
    <x-user-profile-component
        :user-name="$viewModel->userName()"
        :user-email="$viewModel->userEmail()"
        :user-role="$viewModel->userRole()"
        :user-department="$viewModel->userDepartment()"
        :created-at="$viewModel->createdAt()"
    />
</x-layout-guest>
