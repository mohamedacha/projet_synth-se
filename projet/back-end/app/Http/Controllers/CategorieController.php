<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        return Categorie::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        return Categorie::create($data);
    }

    public function show(Categorie $categorie)
    {
        return $categorie;
    }

    public function update(Request $request, Categorie $categorie)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $categorie->update($data);

        return $categorie;
    }

    public function destroy(Categorie $categorie)
    {
        $categorie->delete();

        return response()->json(['message' => 'Catégorie supprimée']);
    }
}
