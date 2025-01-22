<?php

namespace App\Http\Controllers;

use App\Models\Categories;  // Import the Categories model
use Illuminate\Http\Request;
use Illuminate\Support\Str;


require 'UUID.php';

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
        $request->validate([
            'Naam' => 'required|string|max:50',
        ]);

        $Categorie = new Categories();
        $Categorie->UUID = Str::uuid()->toString();
        $Categorie->Naam = $request->Naam;

        $newCategorie = Categories::create($Categorie);

        return response()->json($newCategorie, 201);  // Retourneer de nieuw gemaakte categorie met HTTP-status 201
    }

    // Toon de specifieke categorie
    public function show($UUID)
    {
        $Categorie = Categories::find($UUID);

        if (!$Categorie) {
            return response()->json(['message' => 'Categorie niet gevonden'], 404);
        }

        return response()->json($Categorie);
    }

    // Werk de gegevens van een specifieke categorie bij
    public function update(Request $request, $UUID)
    {
        $validated = $request->validate([
            'Naam' => 'required|string|max:50',
            'Aanmaakdatum' => 'required|date',
        ]);

        $Categorie = Categories::find($UUID);

        if (!$Categorie) {
            return response()->json(['message' => 'Categorie niet gevonden'], 404);
        }

        $Categorie->update($validated);

        return response()->json($Categorie);
    }

    // Verwijder een categorie
    public function destroy($UUID)
    {
        $Categorie = Categories::find($UUID);

        if (!$Categorie) {
            return response()->json(['message' => 'Categorie niet gevonden'], 404);
        }

        $Categorie->delete();

        return response()->json(['message' => 'Categorie succesvol verwijderd']);
    }
}
