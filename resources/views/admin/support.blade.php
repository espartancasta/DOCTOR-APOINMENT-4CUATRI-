<x-admin-layout
    title="Soporte | Healthify"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
        ['name' => 'Soporte']
    ]"
>
    
    <div class="bg-white p-6 shadow-md rounded-lg max-w-4xl mx-auto border border-gray-100 dark:bg-gray-800 dark:border-gray-700">
        <h2 class="text-xl font-bold mb-4 dark:text-white"><i class="fa-solid fa-headset mr-2 text-indigo-600"></i> Centro de Soporte</h2>
        
        <p class="text-gray-600 dark:text-gray-300 mb-6">
            Bienvenido al área de soporte de Healthify. Nuestro equipo está dispuesto a ayudarte en cualquier duda o problema relacionado con el uso del sistema.
        </p>
        
        <div class="space-y-4">
            <div class="p-4 border border-gray-200 dark:border-gray-600 rounded-md bg-gray-50 dark:bg-gray-700">
                <h3 class="font-semibold text-gray-800 dark:text-gray-100"><i class="fa-solid fa-envelope mr-2"></i> Correo Electrónico</h3>
                <p class="text-sm mt-1 text-gray-500 dark:text-gray-400">Envíanos un correo a <strong>soporte@healthify.com</strong> y te responderemos en un lapso no mayor a 24 horas hábiles.</p>
            </div>
            
            <div class="p-4 border border-gray-200 dark:border-gray-600 rounded-md bg-gray-50 dark:bg-gray-700">
                <h3 class="font-semibold text-gray-800 dark:text-gray-100"><i class="fa-solid fa-phone mr-2"></i> Teléfono</h3>
                <p class="text-sm mt-1 text-gray-500 dark:text-gray-400">Comunícate directamente a nuestra línea de atención: <strong>+1 (800) 123-4567</strong></p>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button class="px-4 py-2 bg-indigo-600 text-white rounded shadow hover:bg-indigo-700 transition">
                <i class="fa-solid fa-ticket mr-1"></i> Abrir Nuevo Ticket
            </button>
        </div>
    </div>

</x-admin-layout>
