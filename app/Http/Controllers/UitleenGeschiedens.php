<?php

namespace App\Http\Controllers;

use App\Models\Uitleengeschiedenis;  // Import the Uitleengeschiedenis model
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class UitleengeschiedenisController extends Controller
{
    // Toon een lijst van alle uitleengeschiedenissen
    public function index()
    {
        $uitleengeschiedenissen = Uitleengeschiedenis::all();
        return response()->json($uitleengeschiedenissen);
    }

    // Sla een nieuwe uitleengeschiedenis op in de database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'VoorwerpUUID' => 'required|exists:voorwerpen,UUID',
            'KindUUID' => 'required|exists:kinderen,UUID',
            'Uitleendatum' => 'required|date',
            'Aanmaakdatum' => 'required|date',
        ]);
        
        $validated['UUID'] = Str::uuid()->toString();

        $uitleengeschiedenis = Uitleengeschiedenis::create($validated);

        return response()->json($uitleengeschiedenis, 201);  // Retourneer de nieuw gemaakte uitleengeschiedenis met HTTP-status 201
    }

    // Toon de specifieke uitleengeschiedenis
    public function show($id)
    {
        $uitleengeschiedenis = Uitleengeschiedenis::find($id);

        if (!$uitleengeschiedenis) {
            return response()->json(['message' => 'Uitleengeschiedenis niet gevonden'], 404);
        }

        return response()->json($uitleengeschiedenis);
    }

    // Werk de gegevens van een specifieke uitleengeschiedenis bij
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'VoorwerpUUID' => 'required|exists:voorwerpen,UUID',
            'KindUUID' => 'required|exists:kinderen,UUID',
            'Uitleendatum' => 'required|date',
            'Aanmaakdatum' => 'required|date',
        ]);

        $uitleengeschiedenis = Uitleengeschiedenis::find($id);

        if (!$uitleengeschiedenis) {
            return response()->json(['message' => 'Uitleengeschiedenis niet gevonden'], 404);
        }

        $uitleengeschiedenis->update($validated);

        return response()->json($uitleengeschiedenis);
    }

    // Verwijder een uitleengeschiedenis
    public function destroy($id)
    {
        $uitleengeschiedenis = Uitleengeschiedenis::find($id);

        if (!$uitleengeschiedenis) {
            return response()->json(['message' => 'Uitleengeschiedenis niet gevonden'], 404);
        }

        $uitleengeschiedenis->delete();

        return response()->json(['message' => 'Uitleengeschiedenis succesvol verwijderd']);
    }
}
