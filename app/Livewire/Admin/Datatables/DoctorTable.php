<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class DoctorTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return User::whereHas('roles', function ($query) {
            $query->where('name', 'doctor');
        });
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),

            Column::make("Nombre", "name")
                ->searchable()
                ->sortable(),

            Column::make("Email", "email")
                ->searchable()
                ->sortable(),

            Column::make("Número de id", "id_number")
                ->searchable()
                ->sortable(),

            Column::make("Teléfono", "phone")
                ->searchable()
                ->sortable(),

            // Podría mostrarse "Especialidad" si el User modelo tiene la columna (no la hemos creado, omitimos o dejamos genérico)
            Column::make("Especialidad")
                ->label(fn() => 'General'),

            Column::make('Acciones')
                ->label(function ($row) {
                    return view('admin.doctors.actions', ['doctor' => $row]);
                }),
        ];
    }
}
