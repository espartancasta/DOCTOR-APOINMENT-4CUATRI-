<x-admin-layout title="Pacientes | Jose"
:breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Pacientes',
   
    ],
    
     @livewire('admin.datatables.patients-table')



</x-admin-layout>