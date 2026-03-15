<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder;

class AppointmentTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Appointment::with(['patient.user', 'doctor'])->select('appointments.*');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),

            Column::make("Paciente", "patient.user.name")
                ->sortable(),

            Column::make("Doctor", "doctor.name")
                ->sortable(),

            Column::make("Fecha", "date")
                ->sortable(),

            Column::make("Hora inicio", "start_time")
                ->sortable(),

            Column::make("Hora fin", "end_time")
                ->sortable(),

            Column::make("Estatus", "status")
                ->sortable()
                ->format(function($value) {
                    return $value == 1 ? '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pendiente</span>' : '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Atendido</span>';
                })->html(),

            Column::make('Atención')
                ->label(function ($row) {
                    return view('admin.appointments.actions', ['appointment' => $row]);
                }),
        ];
    }
}
