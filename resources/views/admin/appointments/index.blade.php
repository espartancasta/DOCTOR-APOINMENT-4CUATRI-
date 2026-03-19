<x-admin-layout
    title="Citas | Healthify"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard'),
        ],
        [
            'name' => 'Citas',
        ],
    ]"
>
    
    <div class="mb-4 flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4">
        <a href="{{ route('admin.appointments.create') }}" class="px-5 py-2.5 text-sm font-medium text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <i class="fa-solid fa-plus mr-2"></i> Nueva Cita
        </a>
    </div>

    @livewire('admin.datatables.appointment-table')

</x-admin-layout>
