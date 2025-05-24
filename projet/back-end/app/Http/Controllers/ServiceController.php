<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return Service::with('categorie')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom'         => 'required|string|max:255',
            'prix'        => 'required|numeric|min:0',
            'categorie_id'=> 'required|exists:categories,id',
        ]);

        $service = Service::create($data);

        return response()->json($service, 201);
    }

    public function show(Service $service)
    {
        return $service->load('categorie');
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'nom'         => 'sometimes|string|max:255',
            'prix'        => 'sometimes|numeric|min:0',
            'categorie_id'=> 'sometimes|exists:categories,id',
        ]);

        $service->update($data);

        return response()->json($service);
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return response()->json(['message' => 'Service supprimé avec succès.']);
    }
}
