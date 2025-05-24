<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    public function index()
    {
        return Vehicule::with('client')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id' => 'required|exists:users,id',
            'marque'    => 'required|string|max:255',
            'modele'    => 'required|string|max:255',
            'immatriculation' => 'required|string|max:100|unique:vehicules',
        ]);

        return Vehicule::create($data);
    }

    public function show(Vehicule $vehicule)
    {
        return $vehicule->load('client');
    }

    public function update(Request $request, Vehicule $vehicule)
    {
        $data = $request->validate([
            'marque' => 'sometimes|string|max:255',
            'modele' => 'sometimes|string|max:255',
            'immatriculation' => 'sometimes|string|max:100|unique:vehicules,immatriculation,' . $vehicule->id,
        ]);

        $vehicule->update($data);

        return $vehicule;
    }

    public function destroy(Vehicule $vehicule)
    {
        $vehicule->delete();

        return response()->json(['message' => 'Véhicule supprimé']);
    }
}
