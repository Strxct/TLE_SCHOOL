<?php

namespace App\Http\Controllers;

use App\Models\Categories;  // Import the Categories model
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    // Toon een lijst van alle categorieën
    public function index()
    {
        $categories = Categories::all();
        return response()->json($categories);
    }

    // Sla een nieuwe categorie op in de database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'UUID' => 'required|unique:categories,UUID',
            'Naam' => 'required|string|max:50',
            'Aanmaakdatum' => 'required|date',
        ]);

        $Categorie = Categories::create($validated);

        return response()->json($Categorie, 201);  // Retourneer de nieuw gemaakte categorie met HTTP-status 201
    }

    // Toon de specifieke categorie
    public function show($id)
    {
        $Categorie = Categories::find($id);

        if (!$Categorie) {
            return response()->json(['message' => 'Categorie niet gevonden'], 404);
        }

        return response()->json($Categorie);
    }

    // Werk de gegevens van een specifieke categorie bij
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'Naam' => 'required|string|max:50',
            'Aanmaakdatum' => 'required|date',
        ]);

        $Categorie = Categories::find($id);

        if (!$Categorie) {
            return response()->json(['message' => 'Categorie niet gevonden'], 404);
        }

        $Categorie->update($validated);

        return response()->json($Categorie);
    }

    // Verwijder een categorie
    public function destroy($id)
    {
        $Categorie = Categories::find($id);

        if (!$Categorie) {
            return response()->json(['message' => 'Categorie niet gevonden'], 404);
        }

        $Categorie->delete();

        return response()->json(['message' => 'Categorie succesvol verwijderd']);
    }
}
