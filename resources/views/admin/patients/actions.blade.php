<div class="flex items-center space-x-2">
    <!-- Botón Editar -->
    <x-wire-button href="{{ route('admin.patients.edit', $patient) }}" blue xs>
        <i class="fa-solid fa-pen-to-square"></i>
    </x-wire-button>

    <!-- Botón Eliminar -->
