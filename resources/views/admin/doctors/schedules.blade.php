<x-admin-layout
    title="Horarios | Healthify"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
        ['name' => 'Doctores', 'href' => route('admin.doctors.index')],
        ['name' => 'Horarios']
    ]"
>
    
    <div class="bg-white p-6 shadow-md rounded-lg mx-auto border border-gray-100 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-between items-center mb-6 border-b pb-4 dark:border-gray-700">
            <div>
                <h2 class="text-xl font-bold dark:text-white">Gestor de horarios</h2>
                <p class="text-sm text-gray-500 mt-1">Dr. {{ $doctor->name }}</p>
            </div>
            <button class="px-5 py-2.5 text-sm font-medium text-white inline-flex items-center bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 rounded-lg text-center dark:hover:bg-indigo-600">
                Guardar horario
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3 border-b">DÍA/HORA</th>
                        <th class="px-6 py-3 border-b text-center">LUNES</th>
                        <th class="px-6 py-3 border-b text-center">MARTES</th>
                        <th class="px-6 py-3 border-b text-center">MIÉRCOLES</th>
                        <th class="px-6 py-3 border-b text-center">JUEVES</th>
                        <th class="px-6 py-3 border-b text-center">VIERNES</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $hours = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00'];
                    @endphp
                    @foreach($hours as $hour)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="pr-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white align-top">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500">
                                <span class="ml-2">{{ $hour }}</span>
                            </label>
                        </td>
                        @for($i = 0; $i < 5; $i++)
                        <td class="px-2 py-4 align-top text-center border-l dark:border-gray-700">
                            <div class="space-y-2">
                                <label class="inline-flex items-center w-full justify-center">
                                    <input type="checkbox" class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500">
                                    <span class="ml-2 text-xs text-gray-600">Todos</span>
                                </label>
                                <!-- Blocks -->
                                @php
                                    $baseTime = \Carbon\Carbon::createFromTimeString($hour.':00');
                                @endphp
                                @for($j=0; $j<4; $j++)
                                    @php
                                        $label = $baseTime->format('H:i') . ' - ' . $baseTime->copy()->addMinutes(15)->format('H:i');
                                        $baseTime->addMinutes(15);
                                    @endphp
                                    <label class="inline-flex items-center w-full justify-center">
                                        <input type="checkbox" class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500" {{ rand(0,1) ? 'checked' : '' }}>
                                        <span class="ml-2 text-xs text-gray-500">{{ $label }}</span>
                                    </label>
                                @endfor
                            </div>
                        </td>
                        @endfor
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
