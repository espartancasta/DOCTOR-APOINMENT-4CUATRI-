<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Aseguradoras',
    ]
]">
    <div class="mb-4 flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-800">Aseguradoras</h2>
        <a href="{{ route('insurances.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 outline-none">
            Nueva Aseguradora
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 mb-6" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Nombre de la empresa</th>
                    <th scope="col" class="px-6 py-3">Teléfono de contacto</th>
                    <th scope="col" class="px-6 py-3">Fecha de registro</th>
                </tr>
            </thead>
            <tbody>
                @forelse($insurances as $insurance)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $insurance->id }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $insurance->nombre_empresa }}</td>
                        <td class="px-6 py-4">{{ $insurance->telefono_contacto }}</td>
                        <td class="px-6 py-4">{{ $insurance->created_at->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr class="bg-white border-b">
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            No hay aseguradoras registradas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
