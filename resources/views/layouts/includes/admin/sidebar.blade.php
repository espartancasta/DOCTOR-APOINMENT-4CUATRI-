@php
$links = [
    [
        'name' => 'Dashboard',
        'icon' => 'fa-solid fa-gauge',
        'href' => route('admin.dashboard'),
        'active' => request()->routeIs('admin.dashboard'),
        'enabled' => true,
    ],
    [
        'header' => 'Gestión',
    ],
    [
        'name' => 'Roles y permisos',
        'icon' => 'fa-solid fa-shield-halved',
        'href' => route('admin.roles.index'),
        'active' => request()->routeIs('admin.roles.*'),
        'enabled' => true,
    ],
    [
        'name' => 'Usuarios',
        'icon' => 'fa-solid fa-users',
        'href' => route('admin.users.index'),
        'active' => request()->routeIs('admin.users.*'),
        'enabled' => true,
    ],
    [
        'name' => 'Pacientes',
        'icon' => 'fa-solid fa-user-injured',
        'href' => route('admin.patients.index'),
        'active' => request()->routeIs('admin.patients.*'),
        'enabled' => true,
    ],
    [
        'name' => 'Doctores',
        'icon' => 'fa-solid fa-user-doctor',
        'href' => route('admin.doctors.index'),
        'active' => request()->routeIs('admin.doctors.*'),
        'enabled' => true,
    ],
    [
        'name' => 'Citas médicas',
        'icon' => 'fa-solid fa-calendar-check',
        'href' => route('admin.appointments.index'),
        'active' => request()->routeIs('admin.appointments.*'),
        'enabled' => true,
    ],
    [
        'name' => 'Calendario',
        'icon' => 'fa-solid fa-calendar-days',
        'href' => route('admin.calendar'),
        'active' => request()->routeIs('admin.calendar'),
        'enabled' => true,
    ],
    [
        'name' => 'Soporte',
        'icon' => 'fa-solid fa-circle-question',
        'href' => route('admin.support'),
        'active' => request()->routeIs('admin.support'),
        'enabled' => true,
    ],
];
@endphp

<aside id="logo-sidebar"
       class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full sm:translate-x-0 bg-white border-r border-gray-200"
       aria-label="Sidebar">

    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
                <li>
                    @isset($link['header'])
                        <div class="px-2 py-2 text-xs font-semibold text-gray-500 uppercase">
                            {{ $link['header'] }}
                        </div>
                    @else
                        @if ($link['enabled'])
                            <a href="{{ $link['href'] }}"
                               class="flex items-center p-2 rounded-lg transition hover:bg-gray-100 {{ $link['active'] ? 'bg-gray-100 text-gray-900' : 'text-gray-700' }}">
                                <i class="{{ $link['icon'] }} w-5 h-5 text-gray-500"></i>
                                <span class="ml-3">{{ $link['name'] }}</span>
                            </a>
                        @else
                            <div class="flex items-center p-2 rounded-lg text-gray-500">
                                <i class="{{ $link['icon'] }} w-5 h-5 text-gray-400"></i>
                                <span class="ml-3">{{ $link['name'] }}</span>
                            </div>
                        @endif
                    @endisset
                </li>
            @endforeach
        </ul>
    </div>
</aside>
