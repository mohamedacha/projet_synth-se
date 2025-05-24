<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['categorie_id', 'nom', 'description', 'prix', 'duree'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class)
                    ->withPivot('quantité', 'sous_total')
                    ->withTimestamps();
    }
}

