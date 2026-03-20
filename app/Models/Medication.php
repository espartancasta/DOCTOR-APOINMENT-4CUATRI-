<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultation_id',
        'name',
        'dose',
        'frequency',
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }
}
