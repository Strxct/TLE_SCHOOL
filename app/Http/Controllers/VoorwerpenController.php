<?php

namespace App\Http\Controllers;

use App\Models\Voorwerpen;  // Import the Voorwerpen model
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class VoorwerpenController extends Controller
{
    // Toon een lijst van alle voorwerpen
    public function index()
    {
        $voorwerpen = Voorwerpen::all();
        return response()->json($voorwerpen);
    }

    // Sla een nieuw voorwerp op in de database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'CategorieUUID' => 'required|exists:categories,UUID',
            'Naam' => 'required|string|max:100',
            'Beschrijving' => 'required|string',
            'Notities' => 'required|string',
            'QR' => 'required|string|max:255',
            'Foto' => 'required|string|max:255',
            'Actief' => 'required|boolean',
            'Aanmaakdatum' => 'required|date',
        ]);

        $validated['UUID'] = Str::uuid()->toString();

        $voorwerp = Voorwerpen::create($validated);

        return response()->json($voorwerp, 201);  // Retourneer het nieuw gemaakte voorwerp met HTTP-status 201
    }

    // Toon een specifiek voorwerp
    public function show($id)
    {
        $voorwerp = Voorwerpen::find($id);

        if (!$voorwerp) {
            return response()->json(['message' => 'Voorwerpen niet gevonden'], 404);
        }

        return response()->json($voorwerp);
    }

    // Werk de gegevens van een specifiek voorwerp bij
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'CategorieUUID' => 'required|exists:categories,UUID',
            'Naam' => 'required|string|max:100',
            'Beschrijving' => 'required|string',
            'Notities' => 'required|string',
            'QR' => 'required|string|max:255',
            'Foto' => 'required|string|max:255',
            'Actief' => 'required|boolean',
            'Aanmaakdatum' => 'required|date',
        ]);

        $voorwerp = Voorwerpen::find($id);

        if (!$voorwerp) {
            return response()->json(['message' => 'Voorwerpen niet gevonden'], 404);
        }

        $voorwerp->update($validated);

        return response()->json($voorwerp);
    }

    // Verwijder een voorwerp
    public function destroy($id)
    {
        $voorwerp = Voorwerpen::find($id);

        if (!$voorwerp) {
            return response()->json(['message' => 'Voorwerpen niet gevonden'], 404);
        }

        $voorwerp->delete();

        return response()->json(['message' => 'Voorwerpen succesvol verwijderd']);
    }
}
