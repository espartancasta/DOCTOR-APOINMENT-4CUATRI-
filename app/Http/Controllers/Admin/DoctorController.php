<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.doctors.index');
    }

    /**
     * View the doctor's schedules.
     */
    public function schedules(User $doctor)
    {
        return view('admin.doctors.schedules', compact('doctor'));
    }
}
