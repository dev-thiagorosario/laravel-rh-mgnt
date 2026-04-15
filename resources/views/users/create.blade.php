<x-layout-guest page-title="Criar Usuario">
    <x-create-user-component
        :departments="$viewModel->departments()"
        :roles="$viewModel->roles()"
        :permissions="$viewModel->permissions()"
        :submit-url="$submitUrl"
    />
</x-layout-guest>
