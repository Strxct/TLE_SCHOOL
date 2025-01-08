<?php

namespace App\Http\Controllers;

use App\Models\Mentoren;  // Import the Mentoren model
use Illuminate\Http\Request;

class MentorenController extends Controller
{
    // Toon een lijst van alle Mentorenen
    public function index()
    {
        $Mentoren = Mentoren::all();
        return response()->json($Mentoren);
    }

    // Sla een nieuwe Mentoren op in de database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'UUID' => 'required|unique:Mentorenen,UUID',
            'Voornaam' => 'required|string|max:50',
            'Achternaam' => 'required|string|max:50',
            'Email' => 'required|email|max:50',
            'Wachtwoord' => 'required|string|min:8',
            'Admin' => 'required|boolean',
            'Aanmaakdatum' => 'required|date',
        ]);

        $Mentor = Mentoren::create($validated);

        return response()->json($Mentor, 201);  // Retourneer de nieuw gemaakte Mentoren met HTTP-status 201
    }

    // Toon de specifieke Mentoren
    public function show($id)
    {
        $Mentor = Mentoren::find($id);

        if (!$Mentor) {
            return response()->json(['message' => 'Mentor niet gevonden'], 404);
        }

        return response()->json($Mentor);
    }

    // Werk de gegevens van een specifieke Mentoren bij
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'Voornaam' => 'required|string|max:50',
            'Achternaam' => 'required|string|max:50',
            'Email' => 'required|email|max:50',
            'Wachtwoord' => 'nullable|string|min:8',  // Wachtwoord kan optioneel zijn bij update
            'Admin' => 'required|boolean',
            'Aanmaakdatum' => 'required|date',
        ]);

        $Mentor = Mentoren::find($id);

        if (!$Mentor) {
            return response()->json(['message' => 'Mentor niet gevonden'], 404);
        }

        $Mentor->update($validated);

        return response()->json($Mentor);
    }

    // Verwijder een Mentoren
    public function destroy($id)
    {
        $Mentor = Mentoren::find($id);

        if (!$Mentor) {
            return response()->json(['message' => 'Mentor niet gevonden'], 404);
        }

        $Mentor->delete();

        return response()->json(['message' => 'Mentor succesvol verwijderd']);
    }
}
