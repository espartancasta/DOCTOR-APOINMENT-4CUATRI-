<x-admin-layout
    title="Nueva Cita | Healthify"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
        ['name' => 'Citas', 'href' => route('admin.appointments.index')],
        ['name' => 'Nuevo']
    ]"
>
    <div class="max-w-7xl mx-auto">
        
        <form action="{{ route('admin.appointments.store') }}" method="POST">
            @csrf
            
            <!-- Top Search Availability (Visual Mockup for Layout) -->
            <div class="bg-white p-6 shadow-sm rounded-lg border border-gray-100 mb-6">
                <h2 class="text-lg font-bold text-gray-800 mb-1">Buscar disponibilidad</h2>
                <p class="text-sm text-gray-500 mb-4">Encuentra el horario perfecto para tu cita</p>
                
                <div class="flex flex-col md:flex-row gap-4 items-end">
                    <div class="w-full md:w-1/3">
                        <x-label for="date" value="Fecha" class="text-xs font-semibold uppercase text-gray-500 mb-1" />
                        <x-input id="date" type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" class="block w-full text-sm" required />
                    </div>
                    
                    <div class="w-full md:w-1/3">
                        <x-label for="start_time" value="Hora inicio" class="text-xs font-semibold uppercase text-gray-500 mb-1" />
                        <x-input id="start_time" type="time" name="start_time" value="{{ old('start_time', '08:00') }}" class="block w-full text-sm" required />
                    </div>

                    <div class="w-full md:w-1/3">
                        <x-label for="end_time" value="Hora fin" class="text-xs font-semibold uppercase text-gray-500 mb-1" />
                        <x-input id="end_time" type="time" name="end_time" value="{{ old('end_time', '08:30') }}" class="block w-full text-sm" required />
                    </div>
                </div>
                <!-- Validation Errors for Date/Time -->
                <div class="mt-2 text-red-500 text-xs flex space-x-4">
                    @error('date') <span>{{ $message }}</span> @enderror
                    @error('start_time') <span>{{ $message }}</span> @enderror
                    @error('end_time') <span>{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Content Split -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Left Column: Doctors list (Simulated selection interface) -->
                <div class="col-span-2 space-y-4">
                    <p class="text-sm font-semibold text-gray-600 mb-2">Selecciona un doctor disponible:</p>

                    @foreach($doctors as $doctor)
                    <div class="bg-white p-5 shadow-sm rounded-lg border border-blue-50 relative flex items-start">
                        <div class="mr-4 mt-1">
                            <input type="radio" id="doc_{{ $doctor->id }}" name="doctor_id" value="{{ $doctor->id }}" class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500" {{ old('doctor_id') == $doctor->id ? 'checked' : '' }} required>
                        </div>
                        <label for="doc_{{ $doctor->id }}" class="flex-1 cursor-pointer">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                                    {{ substr($doctor->name, 0, 2) }}
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">Dr(a). {{ $doctor->name }}</h3>
                                    <p class="text-xs text-blue-500 font-medium">Medicina General</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Horarios disponibles seleccionables:</p>
                                <span class="bg-blue-600 text-white text-xs px-4 py-1.5 rounded-full inline-block">Asignación manual</span>
                            </div>
                        </label>
                    </div>
                    @endforeach
                    @error('doctor_id') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>

                <!-- Right Column: Summary Card -->
                <div class="col-span-1">
                    <div class="bg-white p-6 shadow-sm rounded-lg border border-gray-100 sticky top-24">
                        <h2 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Resumen de la cita</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <x-label for="patient_id" value="Paciente" class="text-xs font-semibold uppercase text-gray-500 mb-1" />
                                <select id="patient_id" name="patient_id" class="block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    <option value="">Seleccione un paciente...</option>
                                    @foreach($patients as $patient)
                                        <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                            {{ $patient->user->name ?? 'Sin usuario' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('patient_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <x-label for="reason" value="Motivo de la cita" class="text-xs font-semibold uppercase text-gray-500 mb-1" />
                                <textarea id="reason" name="reason" rows="3" class="block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Chequeo médico..." required>{{ old('reason') }}</textarea>
                                @error('reason') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div class="pt-4 border-t mt-4">
                                <button type="submit" class="w-full text-center px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-sm transition">
                                    Confirmar cita
                                </button>
                                <a href="{{ route('admin.appointments.index') }}" class="block text-center w-full mt-2 text-gray-500 text-xs hover:underline">Cancelar y volver</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</x-admin-layout>
