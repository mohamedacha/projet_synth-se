<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['client_id', 'vehicule_id', 'date', 'statut', 'total'];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class)
                    ->withPivot('quantité', 'sous_total')
                    ->withTimestamps();
    }
}

