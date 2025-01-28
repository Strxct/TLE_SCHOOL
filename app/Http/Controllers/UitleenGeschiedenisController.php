<?php

namespace App\Http\Controllers;

use App\Models\Uitleengeschiedenis;  // Import the Uitleengeschiedenis model
use App\Models\Voorwerpen;
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

    // stuur een voorwerp dat is uitgeleend
    public function getUitgeleend($uuid)
    {
        $uitleengeschiedenissen = Uitleengeschiedenis::where('VoorwerpUUID', $uuid)->where('Uitgeleend', 1)->first();
        return response()->json($uitleengeschiedenissen);
    }
    // retourneer een voorwerp dat is uitgeleend
    public function retourUitgeleend(Request $request)
    {
        $validated = $request->validate([
            'VoorwerpUUID' => 'required|exists:voorwerpen,UUID',
            'Notitie' => 'nullable|string',
        ]);

        if ($validated['Notitie'] !== null) {
            $Voorwerp = Voorwerpen::where('UUID', $validated['VoorwerpUUID'])->first();
            $Voorwerp->update(['Notitie' => $validated['Notitie']]);
        }

        $uitleengeschiedenissen = Uitleengeschiedenis::where('VoorwerpUUID', $validated['VoorwerpUUID'])->where('Uitgeleend', 1)->first();
        if (!$uitleengeschiedenissen) {
            return redirect('/voorwerpen')->with('msg', 'Voorwerp is niet uitgeleend');
        }

        $uitleengeschiedenissen->update(['Uitgeleend' => 0]);
        // return response()->json($uitleengeschiedenissen);
        return redirect('/voorwerpen')->with('msg', 'Voorwerp is teruggebracht');
    }

    // Sla een nieuwe uitleengeschiedenis op in de database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'VoorwerpUUID' => 'required|exists:voorwerpen,UUID',
            'KindUUID' => 'required|exists:kinderen,UUID',
            'Uitleendatum' => 'nullable|date',
            'Aanmaakdatum' => 'nullable|date',
            'Uitgeleend' => 'nullable|boolean',
        ]);
        
        $validated['UUID'] = Str::uuid()->toString();

        $uitgeleend = Uitleengeschiedenis::where('VoorwerpUUID', $validated['VoorwerpUUID'])->where('Uitgeleend', 1)->first();
        // dd($uitgeleend->toArray());
        if ($uitgeleend) {
            
            $uitgeleend->update(['Uitgeleend' => 0]);
        }
        Uitleengeschiedenis::create($validated);

        return redirect('/kinderen/' . $validated['KindUUID'])->with('msg', 'Voorwerp is uitgeleend');

        // return response()->json($uitleengeschiedenis, 201);  // Retourneer de nieuw gemaakte uitleengeschiedenis met HTTP-status 201
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
