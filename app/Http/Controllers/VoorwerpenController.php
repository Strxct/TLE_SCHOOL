<?php

namespace App\Http\Controllers;

use App\Models\Voorwerpen;  // Import the Voorwerpen model
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Categories;
use App\Models\Reserveringen;


class VoorwerpenController extends Controller
{
    // Toon een lijst van alle voorwerpen
    public function index()
    {
        $Categories = Categories::all();
        $Reserveringen = Reserveringen::all();
        $Voorwerpen = Voorwerpen::latest()->paginate(5);
        // return response()->json($voorwerpen);
        return view('voorwerpen.index', compact('Voorwerpen', 'Categories', 'Reserveringen'));
    }

    public function create()
    {
        $Categories = Categories::all();
        return view('voorwerpen.create', compact('Categories'));
        // return view('voorwerpen.create');
    }

    public function edit($id)
    {
        $voorwerp = Voorwerpen::findOrFail($id);
        $Categories = Categories::all();
        return view('voorwerpen.edit', compact('voorwerp', 'Categories'));
    }

    // Sla een nieuw voorwerp op in de database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'CategorieUUID' => 'required|exists:categories,UUID',
            'Naam' => 'required|string|max:100',
            'Beschrijving' => 'nullable|string',
            'Notities' => 'nullable|string',
            'QR' => 'required|string|max:255',
            'Foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'leeftijd_van' => 'nullable|integer',
            'leeftijd_tot' => 'nullable|integer',
            'Actief' => 'required|boolean',
        ]);

        if ($request->hasFile('Foto')) {
            $filePath = $request->file('Foto')->store('voorwerpen', 'public');
            $validated['Foto'] = $filePath;
        }

        $validated['UUID'] = Str::uuid()->toString();

        Voorwerpen::create($validated);

        return redirect('/voorwerpen')->with('msg', 'Voorwerp created successfully');
    }

    // Toon een specifiek voorwerp
    public function show($id)
    {
        $voorwerp = Voorwerpen::findOrFail($id);
        $Categories = Categories::all();
        $Reserveringen = Reserveringen::all();
        return view('voorwerpen.show', compact('voorwerp', 'Categories', 'Reserveringen'));
    }

    // Werk de gegevens van een specifiek voorwerp bij
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'CategorieUUID' => 'required|exists:categories,UUID',
            'Naam' => 'required|string|max:100',
            'Beschrijving' => 'nullable|string',
            'Notities' => 'nullable|string',
            'QR' => 'required|string|max:255',
            'Foto' => 'nullable|string|max:255',
            'leeftijd_van' => 'nullable|integer',
            'leeftijd_tot' => 'nullable|integer',
            'Actief' => 'required|boolean',
        ]);

        dd($validated);
    
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
