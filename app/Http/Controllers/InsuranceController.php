<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Insurance;

class InsuranceController extends Controller
{
    public function index()
    {
        $insurances = Insurance::latest()->get();
        return view('insurances.index', compact('insurances'));
    }

    public function create()
    {
        return view('insurances.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_empresa' => 'required|string|max:255',
            'telefono_contacto' => 'required|string|max:255',
            'notas_adicionales' => 'nullable|string',
        ]);

        Insurance::create($validated);

        return redirect()->route('insurances.index')->with('success', 'Aseguradora registrada exitosamente.');
    }
}
