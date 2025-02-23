<?php

namespace App\Http\Controllers;

use App\Models\Kinderen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Mentoren;
use App\Models\Voorwerpen;

class KinderenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Sorting logic
        $sort = $request->input('sort', 'recent');
        $query = Kinderen::query();
    
        switch ($sort) {
            case 'naam_asc':
                $query->orderBy('Voornaam', 'asc');
                break;
            case 'naam_desc':
                $query->orderBy('Voornaam', 'desc');
                break;
            default:
                $query->latest();
                break;
        }
    
        $Kinderen = $query->paginate(5);
        // $Kinderen = $query->select('kinderen.*')->paginate(5);
        return view('kinderen.index', compact('Kinderen', 'sort'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(session('mentor_admin') == 1) {
            $Mentoren = Mentoren::all();
            return view('kinderen.create', compact('Mentoren'));
        } else {
            return redirect('/kinderen')->with('msg', 'You are not authorized to create a new kind');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Voornaam' => 'required',
            'Achternaam' => 'required',
            'Geboortedatum' => 'required|date',
            'Contact' => 'nullable',
            'MentorUUID' => 'required|exists:mentoren,UUID',
        ]);

        // $Kind = new Kinderen();
        // $Kind->Voornaam = $request->Voornaam;
        // $Kind->Achternaam = $request->Achternaam;
        // $Kind->Geboortedatum = $request->Geboortedatum;
        // $Kind->Contact = $request->Contact;
        // $Kind->MentorUUID = $request->MentorUUID; // Assuming MentorUUID is provided
        $validated['UUID'] = Str::uuid()->toString(); // Populate the UUID

        // print_r($request);
        // die();

        // echo "aspdio]kjas]opfik[dfopgkjpoadsfkjg[oijadsf[guij[z]sdfpoigijkasdfE[]gio";
        // $Kind->save();

        Kinderen::create($validated);

        return redirect('/kinderen')->with('msg', 'Kind created successfully');
        // return response()->json($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Kind = Kinderen::findOrFail($id);
        $Uitgeleend = $Kind->uitleengeschiedenis()->where('KindUUID', $Kind->UUID)->get();
        $Voorwerpen = $Kind->uitleengeschiedenis()->where('KindUUID', $Kind->UUID)->with('voorwerp')->get()->pluck('voorwerp');
        $Mentor = Mentoren::where('UUID', $Kind->MentorUUID)->first();
        // $Voorwerpen = Voorwerpen::all();

        // dd($Uitgeleend);

        return view('kinderen.show', compact('Kind', 'Uitgeleend', 'Voorwerpen', 'Mentor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(session('mentor_admin') == 1) {
            $Kind = Kinderen::findOrFail($id);
            $Mentoren = Mentoren::all();
            return view('kinderen.edit', compact('Kind', 'Mentoren'));
        } else {
            return redirect('/kinderen')->with('msg', 'You are not authorized to edit this kind');
        }
    }

    /**
     * Show the form for scanning the specified resource.
     */
    public function scan(string $id)
    {
        $Kind = Kinderen::findOrFail($id);
        return view('kinderen.scan', compact('Kind'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'Voornaam' => 'required',
            'Achternaam' => 'required',
            'Geboortedatum' => 'required|date',
            'Contact' => 'nullable',
            'MentorUUID' => 'nullable|exists:mentoren,UUID',
        ]);

        $Kind = Kinderen::findOrFail($id);
        $Kind->update($request->all());

        return redirect('/kinderen')->with('msg', 'Kind updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Kind = Kinderen::findOrFail($id);
        $Kind->delete();

        return back()->with('msg', 'Kind deleted successfully');
    }
}