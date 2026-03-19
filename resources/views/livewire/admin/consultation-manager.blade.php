<div x-data="{ tab: 'consulta', showHistoryModal: false, showPatientHistoryModal: false }">
    
    <!-- Header buttons -->
    <div class="mb-4 flex flex-col sm:flex-row justify-between items-center bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-100">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Consulta
            </h2>
            <p class="text-base text-gray-800 font-semibold mt-1">
                {{ $appointment->patient->user->name ?? 'Paciente Desconocido' }}
            </p>
            <p class="text-xs text-gray-500">
                DNI: {{ $appointment->patient->user->id_number ?? 'No registrado' }}
            </p>
        </div>
        <div class="space-x-2 mt-3 sm:mt-0 flex">
            <!-- Botón Ver Historia médica (Mock / Patient module logic) -->
            <button @click="showPatientHistoryModal = true" class="px-4 py-2 border border-blue-600 text-blue-600 text-sm font-medium rounded hover:bg-blue-50 shadow-sm transition">
                <i class="fa-solid fa-notes-medical mr-1"></i> Ver Historia
            </button>
            
            <!-- Botón Consultas Anteriores -->
            <button @click="showHistoryModal = true" class="px-4 py-2 border border-blue-600 text-blue-600 text-sm font-medium rounded hover:bg-blue-50 shadow-sm transition bg-blue-50">
                <i class="fa-solid fa-clock-rotate-left mr-1"></i> Consultas Anteriores
            </button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white p-6 shadow-md rounded-lg border border-gray-100">
        <!-- TABS -->
        <div class="border-b border-gray-200 mb-6">
            <nav class="-mb-px flex space-x-6" aria-label="Tabs">
                <button @click="tab = 'consulta'" :class="{'border-blue-600 text-blue-600': tab === 'consulta', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'consulta'}" class="whitespace-nowrap py-4 px-2 border-b-2 font-medium text-sm transition-colors">
                    <i class="fa-solid fa-stethoscope mr-2"></i> Consulta
                </button>

                <button @click="tab = 'receta'" :class="{'border-blue-600 text-blue-600': tab === 'receta', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'receta'}" class="whitespace-nowrap py-4 px-2 border-b-2 font-medium text-sm transition-colors">
                    <i class="fa-solid fa-pills mr-2"></i> Receta
                </button>
            </nav>
        </div>

        <form wire:submit.prevent="save">
            <!-- CONTENIDO TAB CONSULTA -->
            <div x-show="tab === 'consulta'" class="transition-all">
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Diagnóstico <span class="text-red-500">*</span></label>
                        <textarea wire:model.defer="diagnosis" rows="4" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" required placeholder="Describa el diagnóstico del paciente aquí..."></textarea>
                        @error('diagnosis') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tratamiento <span class="text-red-500">*</span></label>
                        <textarea wire:model.defer="treatment" rows="4" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" required placeholder="Describa el tratamiento recomendado aquí..."></textarea>
                        @error('treatment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Notas (Opcional)</label>
                        <textarea wire:model.defer="notes" rows="3" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" placeholder="Agregue notas adicionales sobre la consulta..."></textarea>
                        @error('notes') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- CONTENIDO TAB RECETA -->
            <div x-show="tab === 'receta'" x-cloak class="transition-all min-h-[300px]">
                
                @error('medications') <p class="text-red-500 text-sm mb-4">{{ $message }}</p> @enderror

                <div class="space-y-4 mb-6">
                    <div class="grid grid-cols-12 gap-4 hidden md:grid font-medium text-xs text-gray-500 uppercase tracking-wider mb-2">
                        <div class="col-span-5">Medicamentos</div>
                        <div class="col-span-3">Dosis</div>
                        <div class="col-span-3">Frecuencia / Duración</div>
                        <div class="col-span-1 text-center"></div>
                    </div>
                    
                    @foreach($medications as $index => $medication)
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center bg-gray-50 p-4 md:p-2 rounded-lg border border-gray-200">
                            <!-- Mobile Labels -->
                            <div class="md:hidden font-medium text-xs text-gray-500 uppercase mb-1">Medicamento</div>
                            
                            <div class="col-span-1 md:col-span-5">
                                <input type="text" wire:model.defer="medications.{{ $index }}.name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white" placeholder="Ej: Amoxicilina 500mg">
                                @error('medications.'.$index.'.name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div class="md:hidden font-medium text-xs text-gray-500 uppercase mt-2 mb-1">Dosis</div>
                            
                            <div class="col-span-1 md:col-span-3">
                                <input type="text" wire:model.defer="medications.{{ $index }}.dose" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white" placeholder="Ej: 1 cada 8 horas">
                                @error('medications.'.$index.'.dose') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div class="md:hidden font-medium text-xs text-gray-500 uppercase mt-2 mb-1">Frecuencia</div>

                            <div class="col-span-1 md:col-span-3 text-right">
                                <input type="text" wire:model.defer="medications.{{ $index }}.frequency" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-100 italic" placeholder="Ej: por 7 días">
                                @error('medications.'.$index.'.frequency') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="col-span-1 md:col-span-1 md:text-center mt-2 md:mt-0 flex justify-end">
                                <button type="button" wire:click="removeMedication({{ $index }})" class="text-red-400 bg-red-50 hover:bg-red-100 hover:text-red-600 px-3 py-2 rounded-md transition" title="Eliminar">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <button type="button" wire:click="addMedication" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-50 transition shadow-sm font-medium">
                    <i class="fa-solid fa-plus mr-1"></i> Añadir Medicamento
                </button>
            </div>

            <!-- Botón Guardar -->
            <div class="mt-8 pt-4 border-t flex justify-end">
                <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-medium text-sm rounded-lg shadow-sm hover:bg-blue-700 transition focus:ring-4 focus:ring-blue-300">
                    <i class="fa-solid fa-save mr-2"></i> Guardar Consulta
                </button>
            </div>
        </form>
    </div>

    <!-- MODAL HISTORIA DEL PACIENTE -->
    <div x-show="showPatientHistoryModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak>
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showPatientHistoryModal" @click="showPatientHistoryModal = false" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="showPatientHistoryModal" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex justify-between items-center w-full mb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Historia médica del paciente
                        </h3>
                        <button @click="showPatientHistoryModal = false" class="text-gray-400 hover:text-gray-500">
                            <i class="fa-solid fa-xmark fa-lg"></i>
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 p-4 border border-blue-50 bg-blue-50/20 rounded-lg">
                        <div>
                            <p class="text-xs text-gray-500">Tipo de sangre:</p>
                            <p class="font-semibold text-gray-800">{{ $appointment->patient->bloodType->name ?? 'No registrado' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Alergias:</p>
                            <p class="font-semibold text-gray-800">{{ $appointment->patient->allergies ?? 'No registradas' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Enfermedades crónicas:</p>
                            <p class="font-semibold text-gray-800">{{ $appointment->patient->chronic_conditions ?? 'No registradas' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Antecedentes quirúrgicos:</p>
                            <p class="font-semibold text-gray-800">{{ $appointment->patient->surgical_history ?? 'No registrados' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex justify-end mt-4">
                        <a href="{{ route('admin.patients.edit', $appointment->patient_id) }}" class="text-blue-600 text-sm font-medium hover:underline">Ver / Editar Historia Médica Completa</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- MODAL HISTORIAL DE CONSULTAS ANTERIORES -->
    <div x-show="showHistoryModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak>
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showHistoryModal" @click="showHistoryModal = false" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="showHistoryModal" class="inline-block align-bottom bg-gray-50 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
                <div class="bg-white px-6 py-4 border-b flex justify-between items-center w-full">
                    <h3 class="text-lg leading-6 font-bold text-gray-800">
                        Consultas Anteriores
                    </h3>
                    <button @click="showHistoryModal = false" class="text-gray-400 hover:text-gray-500">
                        <i class="fa-solid fa-xmark fa-lg"></i>
                    </button>
                </div>
                
                <div class="px-6 py-4 max-h-[65vh] overflow-y-auto space-y-4">
                    @forelse($previousConsultations as $consultation)
                        <div class="bg-white p-5 rounded-lg shadow-sm border border-blue-100 relative">
                            <!-- Fecha / Boton -->
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <div class="flex items-center text-blue-800 font-bold mb-1">
                                        <i class="fa-solid fa-calendar text-blue-500 mr-2"></i>
                                        <span>{{ \Carbon\Carbon::parse($consultation->date)->format('d/m/Y') }}</span>
                                    </div>
                                    <p class="text-xs text-gray-500">Atendido por: Dr(a). {{ $consultation->doctor->name ?? 'Desconocido' }}</p>
                                </div>
                                <button class="text-blue-500 border border-blue-200 px-3 py-1 rounded-md text-xs font-semibold hover:bg-blue-50 transition">Consultar Detalle</button>
                            </div>

                            <!-- Resumen Body -->
                            <div class="mt-4 space-y-1">
                                <p class="text-sm text-gray-700"><span class="font-semibold text-gray-900">Diagnóstico:</span> {{ $consultation->diagnosis }}</p>
                                <p class="text-sm text-gray-600"><span class="font-semibold text-gray-900">Tratamiento:</span> {{ Str::limit($consultation->treatment, 120) }}</p>
                                @if($consultation->notes)
                                    <p class="text-sm text-gray-600"><span class="font-semibold text-gray-900">Notas:</span> {{ Str::limit($consultation->notes, 80) }}</p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 text-gray-500 bg-white rounded-lg border">
                            No hay consultas registradas para este paciente.
                        </div>
                    @endforelse
                </div>
                
                <div class="bg-white px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t">
                    <button type="button" @click="showHistoryModal = false" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:w-auto sm:text-sm">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>