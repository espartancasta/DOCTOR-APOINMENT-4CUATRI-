{{-- Logica de PHP para manejar errores y controlar la pestaña activa --}}
@php
    $errorGrupos = [
        'antecedentes' => ['allergies', 'chronic_conditions', 'surgical_history', 'family_history'],
        'informacion-general' => ['blood_type_id', 'observations'],
        'contacto-emergencia' => [
            'emergency_contact_name',
            'emergency_contact_phone',
            'emergency_contact_relationship',
        ],
    ];

    $initialTab = 'datos-personales';

    foreach ($errorGrupos as $tabName => $fields) {
        if ($errors->hasAny($fields)) {
            $initialTab = $tabName;
            break;
        }
    }
@endphp

<x-admin-layout
    title="Pacientes"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
        ['name' => 'Pacientes', 'href' => route('admin.patients.index')],
        ['name' => 'Editar'],
    ]"
>
    <form action="{{ route('admin.patients.update', $patient) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- HEADER (✅ botones arriba como el video) --}}
        <x-wire-card class="mt-10">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                {{-- Izquierda: avatar + nombre --}}
                <div class="flex items-center gap-4">
                    <img
                        src="{{ $patient->user->profile_photo_url }}"
                        alt="{{ $patient->user->name }}"
                        class="h-16 w-16 sm:h-20 sm:w-20 rounded-full object-cover object-center"
                    >

                    <div class="leading-tight">
                        <p class="text-xl sm:text-2xl font-semibold text-gray-900">
                            {{ $patient->user->name }}
                        </p>
                    </div>
                </div>

                {{-- Derecha: botones --}}
                <div class="flex items-center gap-3 sm:justify-end">
                    <x-wire-button outline gray href="{{ route('admin.patients.index') }}">
                        Volver
                    </x-wire-button>

                    <x-wire-button type="submit">
                        <i class="fa-solid fa-floppy-disk mr-2"></i>
                        Guardar cambios
                    </x-wire-button>
                </div>
            </div>
        </x-wire-card>

        {{-- TABS --}}
        <x-wire-card>
            <div x-data="{ tab: '{{ $initialTab }}' }">

                {{-- Menú --}}
                <div class="border-b border-gray-200">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500">

                        {{-- Tab 1 --}}
                        <li class="me-2">
                            <a href="#"
                               x-on:click.prevent="tab = 'datos-personales'"
                               :class="{
                                   'text-blue-600 border-blue-600 active': tab === 'datos-personales',
                                   'border-transparent hover:text-blue-600 hover:border-blue-600': tab !== 'datos-personales'
                               }"
                               class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200"
                               :aria-current="tab === 'datos-personales' ? 'page' : undefined">
                                <i class="fa-solid fa-user me-2"></i>
                                Datos Personales
                            </a>
                        </li>

                        {{-- Tab 2 --}}
                        @php $hasErrorAntecedentes = $errors->hasAny($errorGrupos['antecedentes']); @endphp
                        <li class="me-2">
                            <a href="#"
                               x-on:click.prevent="tab = 'antecedentes'"
                               :class="{
                                   'text-red-600 border-red-600': {{ $hasErrorAntecedentes ? 'true' : 'false' }} && tab !== 'antecedentes',
                                   'text-blue-600 border-blue-600 active': tab === 'antecedentes' && !{{ $hasErrorAntecedentes ? 'true' : 'false' }},
                                   'text-red-600 border-red-600 active': tab === 'antecedentes' && {{ $hasErrorAntecedentes ? 'true' : 'false' }},
                                   'border-transparent hover:text-blue-600 hover:border-blue-600': tab !== 'antecedentes' && !{{ $hasErrorAntecedentes ? 'true' : 'false' }}
                               }"
                               class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200"
                               :aria-current="tab === 'antecedentes' ? 'page' : undefined">
                                <i class="fa-solid fa-file-lines me-2"></i>
                                Antecedentes
                                @if($hasErrorAntecedentes)
                                    <i class="fa-solid fa-circle-exclamation ms-2 animate-pulse"></i>
                                @endif
                            </a>
                        </li>

                        {{-- Tab 3 --}}
                        @php $hasErrorInfo = $errors->hasAny($errorGrupos['informacion-general']); @endphp
                        <li class="me-2">
                            <a href="#"
                               x-on:click.prevent="tab = 'informacion-general'"
                               :class="{
                                   'text-red-600 border-red-600': {{ $hasErrorInfo ? 'true' : 'false' }} && tab !== 'informacion-general',
                                   'text-blue-600 border-blue-600 active': tab === 'informacion-general' && !{{ $hasErrorInfo ? 'true' : 'false' }},
                                   'text-red-600 border-red-600 active': tab === 'informacion-general' && {{ $hasErrorInfo ? 'true' : 'false' }},
                                   'border-transparent hover:text-blue-600 hover:border-blue-600': tab !== 'informacion-general' && !{{ $hasErrorInfo ? 'true' : 'false' }}
                               }"
                               class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200"
                               :aria-current="tab === 'informacion-general' ? 'page' : undefined">
                                <i class="fa-solid fa-info me-2"></i>
                                Información General
                                @if($hasErrorInfo)
                                    <i class="fa-solid fa-circle-exclamation ms-2 animate-pulse"></i>
                                @endif
                            </a>
                        </li>

                        {{-- Tab 4 --}}
                        @php $hasErrorEmergencia = $errors->hasAny($errorGrupos['contacto-emergencia']); @endphp
                        <li class="me-2">
                            <a href="#"
                               x-on:click.prevent="tab = 'contacto-emergencia'"
                               :class="{
                                   'text-red-600 border-red-600': {{ $hasErrorEmergencia ? 'true' : 'false' }} && tab !== 'contacto-emergencia',
                                   'text-blue-600 border-blue-600 active': tab === 'contacto-emergencia' && !{{ $hasErrorEmergencia ? 'true' : 'false' }},
                                   'text-red-600 border-red-600 active': tab === 'contacto-emergencia' && {{ $hasErrorEmergencia ? 'true' : 'false' }},
                                   'border-transparent hover:text-blue-600 hover:border-blue-600': tab !== 'contacto-emergencia' && !{{ $hasErrorEmergencia ? 'true' : 'false' }}
                               }"
                               class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200"
                               :aria-current="tab === 'contacto-emergencia' ? 'page' : undefined">
                                <i class="fa-solid fa-heart me-2"></i>
                                Contacto de Emergencia
                                @if($hasErrorEmergencia)
                                    <i class="fa-solid fa-circle-exclamation ms-2 animate-pulse"></i>
                                @endif
                            </a>
                        </li>

                    </ul>
                </div>

                {{-- Contenido --}}
                <div class="p-4 mt-4">

                    {{-- TAB 1 --}}
                    <div x-show="tab === 'datos-personales'" style="display:none;">
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded-r-lg shadow-sm">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                                <div class="flex items-start">
                                    <i class="fa-solid fa-user-gear text-blue-500 text-xl mt-1"></i>

                                    <div class="ml-3">
                                        <h3 class="text-sm font-bold text-blue-800">
                                            Edición de cuenta de usuarios
                                        </h3>

                                        <div class="mt-1 text-sm text-blue-600">
                                            Los datos de acceso (nombre, email y contraseña) deben gestionarse desde la cuenta de usuario asociada.
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-shrink-0">
                                    <x-wire-button primary sm
                                        href="{{ route('admin.users.edit', $patient->user) }}"
                                        target="_blank">
                                        Editar usuario
                                        <i class="fa-solid fa-arrow-up-right-from-square ms-2"></i>
                                    </x-wire-button>
                                </div>

                            </div>
                        </div>

                        <div class="grid lg:grid-cols-2 gap-4">
                            <div>
                                <span class="text-gray-500 font-semibold">Teléfono:</span>
                                <span class="text-gray-900 text-sm ml-1">{{ $patient->user->phone }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500 font-semibold">Email:</span>
                                <span class="text-gray-900 text-sm ml-1">{{ $patient->user->email }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500 font-semibold">Dirección:</span>
                                <span class="text-gray-900 text-sm ml-1">{{ $patient->user->address }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- TAB 2: Antecedentes (✅ textareas más pequeñas como el video) --}}
                    <div x-show="tab === 'antecedentes'" style="display:none;">
                        <div class="grid lg:grid-cols-2 gap-4">
                            <div>
                                <x-wire-textarea
                                    label="Alergias conocidas"
                                    name="allergies"
                                    rows="3"
                                    class="resize-none"
                                >{{ old('allergies', $patient->allergies) }}</x-wire-textarea>
                            </div>

                            <div>
                                <x-wire-textarea
                                    label="Enfermedades crónicas"
                                    name="chronic_conditions"
                                    rows="3"
                                    class="resize-none"
                                >{{ old('chronic_conditions', $patient->chronic_conditions) }}</x-wire-textarea>
                            </div>

                            <div>
                                <x-wire-textarea
                                    label="Antecedentes quirúrgicos"
                                    name="surgical_history"
                                    rows="3"
                                    class="resize-none"
                                >{{ old('surgical_history', $patient->surgical_history) }}</x-wire-textarea>
                            </div>

                            <div>
                                <x-wire-textarea
                                    label="Antecedentes familiares"
                                    name="family_history"
                                    rows="3"
                                    class="resize-none"
                                >{{ old('family_history', $patient->family_history) }}</x-wire-textarea>
                            </div>
                        </div>
                    </div>

                    {{-- TAB 3 --}}
                    <div x-show="tab === 'informacion-general'" style="display:none;">
                        <x-wire-native-select label="Tipo de sangre" class="mb-4" name="blood_type_id">
                            <option value="">Seleccione un tipo de sangre</option>
                            @foreach ($bloodTypes as $bloodType)
                                <option value="{{ $bloodType->id }}"
                                    @selected(old('blood_type_id', $patient->blood_type_id) == $bloodType->id)>
                                    {{ $bloodType->name }}
                                </option>
                            @endforeach
                        </x-wire-native-select>

                        <x-wire-textarea
                            label="Observaciones"
                            name="observations"
                            rows="4"
                            class="resize-none"
                        >{{ old('observations', $patient->observations) }}</x-wire-textarea>
                    </div>

                    {{-- TAB 4 --}}
                    <div x-show="tab === 'contacto-emergencia'" style="display:none;">
                        <div class="space-y-4">
                            <x-wire-input
                                label="Nombre del contacto"
                                name="emergency_contact_name"
                                value="{{ old('emergency_contact_name', $patient->emergency_contact_name) }}"
                            />

                            <x-wire-phone
                                label="Teléfono de contacto"
                                name="emergency_contact_phone"
                                mask="(###) ###-####"
                                placeholder="(999) 999-9999"
                                value="{{ old('emergency_contact_phone', $patient->emergency_contact_phone) }}"
                            />

                            <x-wire-input
                                label="Relación con el contacto"
                                name="emergency_contact_relationship"
                                placeholder="Familiar, amigo, etc."
                                value="{{ old('emergency_contact_relationship', $patient->emergency_contact_relationship) }}"
                            />
                        </div>
                    </div>

                </div>
            </div>
        </x-wire-card>
    </form>
</x-admin-layout>
