<x-admin-layout title="Roles | Pedrini"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard'),
        ],
        [
            'name' => 'Roles',
            'href' => route('admin.roles.index'),
        ],
        [
            'name' => 'Detalle',
        ]
    ]">

    <x-wire-card>

        <div class="mb-4">
            <h2 class="text-lg font-bold">Información del Rol</h2>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">
                Nombre
            </label>

            <p class="mt-1 text-gray-900">
                {{ $role->name }}
            </p>
        </div>

        <div class="flex justify-end space-x-2">

            <x-wire-button href="{{ route('admin.roles.edit', $role) }}" blue>
                <i class="fa-solid fa-pen-to-square"></i> Editar
            </x-wire-button>

            <x-wire-button href="{{ route('admin.roles.index') }}" gray>
                <i class="fa-solid fa-arrow-left"></i> Volver
            </x-wire-button>

        </div>

    </x-wire-card>

</x-admin-layout>
