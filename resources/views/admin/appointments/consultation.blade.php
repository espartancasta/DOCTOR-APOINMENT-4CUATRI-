<x-admin-layout
    title="Atención Médica | Healthify"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
        ['name' => 'Citas', 'href' => route('admin.appointments.index')],
        ['name' => 'Consulta']
    ]"
>
    <!-- Incluir Livewire Component -->
    @livewire('admin.consultation-manager', ['appointment' => $appointment])
    
</x-admin-layout>
