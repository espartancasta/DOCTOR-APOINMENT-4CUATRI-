<x-admin-layout
    title="Doctores | Healthify"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
        ['name' => 'Doctores']
    ]"
>
    <!-- Livewire table component -->
    @livewire('admin.datatables.doctor-table')

</x-admin-layout>
