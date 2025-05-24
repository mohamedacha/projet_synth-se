<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password'];

    public function vehicules()
    {
        return $this->hasMany(Vehicule::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'client_id');
    }
}
