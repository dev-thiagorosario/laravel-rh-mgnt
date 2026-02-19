<x-layout-guest page-title="Criar Usuario">
    <x-create-user-component
        :departments="$departments"
        :roles="$roles"
        :permissions="$permissions"
        :submit-url="$submitUrl"
    />
</x-layout-guest>
