<<<<<<< HEAD
<x-admin-layout title="Usuarios | Editar"
=======
<x-admin-layout title="Usuarios | Editar" 
>>>>>>> 4ebee93 (Add automated test for user self-delete restriction)
:breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Usuarios', 'href' => route('admin.users.index')],
    ['name' => 'Editar']
]">

<x-wire-card>
  <form action="{{ route('admin.users.update', $user) }}" method="POST">
    @csrf
    @method('PUT')
<<<<<<< HEAD

    <div class="space-y-4">

      <div class="grid lg:grid-cols-2 gap-4">

        <x-wire-input
          name="name"
          label="Nombre"
          :value="old('name', $user->name)"
          required
          placeholder="Nombre"
          autocomplete="name"
        />

        <x-wire-input
          name="email"
          label="Email"
          :value="old('email', $user->email)"
          required
          placeholder="usuario@dominio.com"
          autocomplete="email"
          inputmode="email"
        />

        <x-wire-input
          name="password"
          label="Contraseña"
          :value="old('password')"
          placeholder="Dejar vacío para no cambiar"
          autocomplete="new-password"
          type="password"
        />

        <x-wire-input
          name="password_confirmation"
          label="Confirmar Contraseña"
          :value="old('password_confirmation')"
          placeholder="Repita la contraseña"
          autocomplete="new-password"
          type="password"
        />

        <x-wire-input
          name="id_number"
          label="Número de ID"
          :value="old('id_number', $user->id_number)"
          required
          placeholder="Ej. 123456"
          autocomplete="off"
          inputmode="numeric"
        />

        <x-wire-input
          name="phone"
          label="Teléfono"
          :value="old('phone', $user->phone)"
          required
          placeholder="Ej. 1234567890"
          autocomplete="tel"
          inputmode="tel"
        />

=======
    <div class="space-y-4">

      <div class="grid lg:grid-cols-2 gap-4">
      <x-wire-input
        name="name"
        label="Nombre"
        :value="old('name', $user->name)"
        required
        placeholder="Nombre"
        autocomplete="name"
      />

      <x-wire-input
        name="email"
        label="Email"
        :value="old('email', $user->email)"
        required
        placeholder="usuario@dominio.com"
        autocomplete="email"
        inputmode="email"
      />

      <x-wire-input
        name="password"
        label="Contraseña"
        :value="old('password')"
        placeholder="Mínimo 8 caracteres"
        autocomplete="new-password"
        type="password"
      />

      <x-wire-input
        name="password_confirmation"
        label="Confirmar Contraseña"
        :value="old('password_confirmation')"
        placeholder="Repita la contraseña"
        autocomplete="new-password"
        type="password"
      />

      <x-wire-input
        name="id_number"
        label="Número de ID"
        required :value="old('id_number', $user->id_number)"
        placeholder="Ej. 123456"
        autocomplete="off"
        inputmode="numeric"
      />

      <x-wire-input
        name="phone"
        label="Teléfono"
        required :value="old('phone', $user->phone)"
        placeholder="Ej. 1234567890"
        autocomplete="tel"
        inputmode="tel"
      />
>>>>>>> 4ebee93 (Add automated test for user self-delete restriction)
      </div>

      <x-wire-input
        name="address"
        label="Dirección"
<<<<<<< HEAD
        :value="old('address', $user->address)"
        required
=======
        required :value="old('address', $user->address)"
>>>>>>> 4ebee93 (Add automated test for user self-delete restriction)
        placeholder="Ej. Calle 123, Ciudad"
        autocomplete="street-address"
      />

      <div>
        <x-wire-native-select name="role_id" label="Rol" required>
          <option value="">Seleccione un rol</option>

          @foreach($roles as $role)
<<<<<<< HEAD
            <option value="{{ $role->id }}"
              @selected(old('role_id', optional($user->roles->first())->id) == $role->id)>
=======
            <option value="{{ $role->id }}" @selected(old('role_id', $user->roles->first()->id) == $role->id)>
>>>>>>> 4ebee93 (Add automated test for user self-delete restriction)
              {{ $role->name }}
            </option>
          @endforeach
        </x-wire-native-select>

        <p class="text-sm text-gray-500">
          Actualizar
        </p>
      </div>

      <div class="flex justify-end">
<<<<<<< HEAD
        <x-wire-button type="submit" blue>
=======
        <x-wire-button
          type="submit" blue>
>>>>>>> 4ebee93 (Add automated test for user self-delete restriction)
          <i class="fa-solid fa-floppy-disk"></i> Guardar Usuario
        </x-wire-button>
      </div>

    </div>
  </form>
</x-wire-card>

</x-admin-layout>
