<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Service;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return Reservation::with(['client', 'vehicule', 'services'])->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id'     => 'required|exists:users,id',
            'vehicule_id'   => 'required|exists:vehicules,id',
            'date'          => 'required|date',
            'services'      => 'required|array',
            // 'services.*.id' => 'required|exists:services,id',
        ]);

        $reservation = Reservation::create([
            'client_id'   => $data['client_id'],
            'vehicule_id' => $data['vehicule_id'],
            'date'        => $data['date'],
            'statut'      => 'en_attente',
            'total'       => 0, // sera recalculé ci-dessous
        ]);

        $total = 0;
        foreach ($data['services'] as $service) {
            $serviceModel = Service::find($service['id']);
            $sous_total = $serviceModel->prix;
            $reservation->services()->attach($serviceModel->id, [
                'quantité' => 1,
                'sous_total' => $sous_total,
            ]);
            $total += $sous_total;
        }

        $reservation->update(['total' => $total]);

        return $reservation->load('services');
    }

    public function show(Reservation $reservation)
    {
        return $reservation->load(['client', 'vehicule', 'services']);
    }

    public function update(Request $request, Reservation $reservation)
    {
        $data = $request->validate([
            'statut' => 'sometimes|in:en_attente,en_cours,terminé,annulé',
            'date'   => 'sometimes|date',
        ]);

        $reservation->update($data);

        return $reservation;
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->services()->detach();
        $reservation->delete();
        return response()->noContent();
    }
}
