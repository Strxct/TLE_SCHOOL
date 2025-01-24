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
        $Voorwerpen = Voorwerpen::latest()->paginate(5);
        // return response()->json($voorwerpen);
        return view('voorwerpen.index', compact('Voorwerpen'));
    }

    public function create()
    {
        return view('voorwerpen.create');
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
    
        Voorwerpen::create($validated);
    
        return redirect('/voorwerpen')->with('msg', 'Voorwerp created successfully');
    }

    // Toon een specifiek voorwerp
    public function show($id)
    {
        $voorwerp = Voorwerpen::findOrFail($id);
        return view('voorwerpen.show', compact('voorwerp'));
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
    
        $voorwerp = Voorwerpen::findOrFail($id);
        $voorwerp->update($validated);
    
        return redirect('/voorwerpen')->with('msg', 'Voorwerp updated successfully');
    }

    // Verwijder een voorwerp
    public function destroy($id)
    {
        $voorwerp = Voorwerpen::findOrFail($id);
        $voorwerp->delete();
    
        return back()->with('msg', 'Voorwerp deleted successfully');
    }
}
