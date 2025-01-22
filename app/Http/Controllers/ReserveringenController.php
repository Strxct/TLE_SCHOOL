<?php

namespace App\Http\Controllers;

use App\Models\Reserveringen;  // Import the Reserveringen model
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReserveringenController extends Controller
{
    // Toon een lijst van alle reserveringen
    public function index()
    {
        $reserveringen = Reserveringen::all();
        return response()->json($reserveringen);
    }

    // Sla een nieuwe reservering op in de database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'MentorUUID' => 'required|exists:mentoren,UUID',
            'VoorwerpUUID' => 'required|exists:voorwerpen,UUID',
            'Aanmaakdatum' => 'required|date',
        ]);

        $validated['UUID'] = Str::uuid()->toString();

        $reservering = Reserveringen::create($validated);

        return response()->json($reservering, 201);  // Retourneer de nieuw gemaakte reservering met HTTP-status 201
    }

    // Toon de specifieke reservering
    public function show($id)
    {
        $reservering = Reserveringen::find($id);

        if (!$reservering) {
            return response()->json(['message' => 'Reservering niet gevonden'], 404);
        }

        return response()->json($reservering);
    }

    // Werk de gegevens van een specifieke reservering bij
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'MentorUUID' => 'required|exists:mentoren,UUID',
            'VoorwerpUUID' => 'required|exists:voorwerpen,UUID',
            'Aanmaakdatum' => 'required|date',
        ]);

        $reservering = Reserveringen::find($id);

        if (!$reservering) {
            return response()->json(['message' => 'Reservering niet gevonden'], 404);
        }

        $reservering->update($validated);

        return response()->json($reservering);
    }

    // Verwijder een reservering
    public function destroy($id)
    {
        $reservering = Reserveringen::find($id);

        if (!$reservering) {
            return response()->json(['message' => 'Reservering niet gevonden'], 404);
        }

        $reservering->delete();

        return response()->json(['message' => 'Reservering succesvol verwijderd']);
    }
}
