<?php

namespace App\Models;

<<<<<<< HEAD
=======
// use Illuminate\Contracts\Auth\MustVerifyEmail;
>>>>>>> 4ebee93 (Add automated test for user self-delete restriction)
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
<<<<<<< HEAD
=======

    /** @use HasFactory<\Database\Factories\UserFactory> */
>>>>>>> 4ebee93 (Add automated test for user self-delete restriction)
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use HasRoles;
    use TwoFactorAuthenticatable;

    /**
<<<<<<< HEAD
     * Campos permitidos para inserción masiva
=======
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
>>>>>>> 4ebee93 (Add automated test for user self-delete restriction)
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_number',
        'phone',
        'address',
    ];

    /**
<<<<<<< HEAD
     * Campos ocultos
=======
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
>>>>>>> 4ebee93 (Add automated test for user self-delete restriction)
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
<<<<<<< HEAD
     * Campos adicionales
=======
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
>>>>>>> 4ebee93 (Add automated test for user self-delete restriction)
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
<<<<<<< HEAD
     * Casts
=======
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
>>>>>>> 4ebee93 (Add automated test for user self-delete restriction)
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
