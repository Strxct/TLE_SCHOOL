<?php

namespace App\Http\Controllers;

use App\Models\Mentoren;  // Import the Mentoren model
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MentorenController extends Controller
{
    // Toon een lijst van alle Mentorenen
    public function index()
    {
        $Mentoren = Mentoren::latest()->paginate(5);
        // return response()->json($Mentoren);
        return view('mentoren.index', compact('Mentoren'));
    }

    public function create()
    {
        return view('mentoren.create');
    }

    // Sla een nieuwe Mentoren op in de database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Voornaam' => 'required|string|max:50',
            'Achternaam' => 'required|string|max:50',
            'Email' => 'required|email|max:50',
            'Wachtwoord' => 'required|string|min:8',
            'Admin' => 'required|boolean'
        ]);

        $validated['UUID'] = Str::uuid()->toString();

        Mentoren::create($validated);

        // return response()->json($Mentor, 201);  // Retourneer de nieuw gemaakte Mentoren met HTTP-status 201
        return redirect('/mentoren')->with('msg', 'Mentor created successfully');
    }

    // Toon de specifieke Mentoren
    public function show($id)
    {
        $Mentor = Mentoren::findOrFail($id);
        return view('mentoren.show', compact('mentor'));
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

        $Mentor = Mentoren::findOrFail($id);
        $Mentor->update($validated);
    
        return redirect('/mentoren')->with('msg', 'Mentor updated successfully');
    }

    // Verwijder een Mentoren
    public function destroy($id)
    {
        $Mentor = Mentoren::findOrFail($id);
        $Mentor->delete();
    
        return back()->with('msg', 'Mentor deleted successfully');
    }
}
