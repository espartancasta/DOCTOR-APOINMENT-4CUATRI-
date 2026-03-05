<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Aseguradoras',
        'href' => route('insurances.index'),
    ],
    [
        'name' => 'Nueva Aseguradora',
    ]
]">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 max-w-4xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Registrar Aseguradora</h2>
        <p class="text-gray-500 mb-6">Complete la información de la nueva aseguradora para agregarla al directorio médico.</p>

        <form action="{{ route('insurances.store') }}" method="POST">
            @csrf
            
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="nombre_empresa" class="block mb-2 text-sm font-medium text-gray-900">Nombre de la empresa <span class="text-red-600">*</span></label>
                    <input type="text" id="nombre_empresa" name="nombre_empresa" value="{{ old('nombre_empresa') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('nombre_empresa') border-red-500 @enderror" placeholder="Ej. Seguros Monterrey" required>
                    @error('nombre_empresa')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="telefono_contacto" class="block mb-2 text-sm font-medium text-gray-900">Teléfono de contacto <span class="text-red-600">*</span></label>
                    <input type="tel" id="telefono_contacto" name="telefono_contacto" value="{{ old('telefono_contacto') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('telefono_contacto') border-red-500 @enderror" placeholder="Ej. 555-123-4567" required>
                    @error('telefono_contacto')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="notas_adicionales" class="block mb-2 text-sm font-medium text-gray-900">Descripción detallada</label>
                <textarea id="notas_adicionales" name="notas_adicionales" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('notas_adicionales') border-red-500 @enderror" placeholder="Notas adicionales o descripción detallada de la aseguradora...">{{ old('notas_adicionales') }}</textarea>
                @error('notas_adicionales')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end space-x-3 mt-8">
                <a href="{{ route('insurances.index') }}" class="text-gray-700 bg-white border border-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-100 hover:bg-gray-50 font-medium rounded-lg text-sm px-5 py-2.5 focus:z-10">
                    Cancelar
                </a>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Guardar Aseguradora
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
