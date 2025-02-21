<?php


namespace App\Http\Controllers;

use App\Models\Voorwerpen;  // Import the Voorwerpen model
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Categories;
use App\Models\Reserveringen;
use App\Models\Uitleengeschiedenis;
use App\Models\Foto;
use App\Models\Mentoren;
use chillerlan\QRCode\{QRCode, QROptions};  
use chillerlan\QRCode\Output\{QROutputInterface};
use App\Models\QR;

class VoorwerpenController extends Controller
{  

    // Toon een lijst van alle voorwerpen
    public function index(Request $request)
    {
        $Categories = Categories::all();
        $Reserveringen = Reserveringen::all();
        $Uitgeleend = Uitleengeschiedenis::where('Uitgeleend', 1)->get();
        $Kinderen = Uitleengeschiedenis::where('Uitgeleend', 1)->with('kind')->get()->pluck('kind');
        $Mentoren = Mentoren::all();
    
        // Sorting logic
        $sort = $request->input('sort', 'recent');
        $categorie = null;
        $query = Voorwerpen::query();
    
        switch ($sort) {
            case 'naam_asc':
                $query->orderBy('Naam', 'asc');
                break;
            case 'naam_desc':
                $query->orderBy('Naam', 'desc');
                break;
            case 'Uitgeleend_desc':
                $query->leftJoin('uitleengeschiedenis', function($join) {
                    $join->on('voorwerpen.UUID', '=', 'uitleengeschiedenis.VoorwerpUUID')
                         ->where('uitleengeschiedenis.Uitgeleend', '=', 1);
                })->orderByRaw('uitleengeschiedenis.Uitgeleend DESC, uitleengeschiedenis.Uitleendatum DESC');
                break;
            case 'Uitgeleend_asc':
                $query->leftJoin('uitleengeschiedenis', function($join) {
                    $join->on('voorwerpen.UUID', '=', 'uitleengeschiedenis.VoorwerpUUID')
                         ->where('uitleengeschiedenis.Uitgeleend', '=', 1);
                })->orderByRaw('uitleengeschiedenis.Uitgeleend DESC, uitleengeschiedenis.Uitleendatum ASC');
                break;
            case 'Categorie':
                $categorie = $request->input('categorie');
                if ($categorie) {
                    $query->where('CategorieUUID', $categorie);
                }
                break;
            case 'Actief_1':
                $query->where('Actief', 1);
                break;
            case 'Actief_0':
                $query->where('Actief', 0);
                break;
            default:
                $query->latest();
                break;
        }
    
        $Voorwerpen = $query->select('voorwerpen.*')->paginate(5);
    
        $Qr = QR::all();
        $Foto = Foto::all();
        return view('voorwerpen.index', compact('Voorwerpen', 'Categories', 'Reserveringen', 'Foto', 'Qr', 'Uitgeleend', 'Kinderen', 'sort', 'categorie', 'Mentoren'));
    }

    public function getVoorwerp($uuid)
    {

        $response = [
            'voorwerp' => null,
            'foto' => null,
        ];
        $voorwerp = Voorwerpen::where('UUID', $uuid)->firstOrFail();
        $response['voorwerp'] = $voorwerp;
        if ($voorwerp->FotoUUID != null) {
            $foto = Foto::where('UUID', $voorwerp->FotoUUID)->firstOrFail();
            $response['foto'] = $foto;
        }

        if ($voorwerp->CategorieUUID != null) {
            $categorie = Categories::where('UUID', $voorwerp->CategorieUUID)->firstOrFail();
            $response['categorie'] = $categorie;
        }


        return response()->json($response);
    }

    public function scan()
    {
        
        return view('voorwerpen.scan');
    }

    public function reserveren($UUID)
    {

        if (session('mentor_uuid') == null) {
            return redirect()->route('login')->with('msg', 'You need to be logged in to reserve a voorwerp');
        }

        $voorwerp = Voorwerpen::where('UUID', $UUID)->first();
        if (!$voorwerp) {
            return redirect()->route('voorwerpen.index')->with('msg', 'Voorwerp not found');
        }

        $existingReservation = Reserveringen::where('VoorwerpUUID', $UUID)->first();
        if ($existingReservation) {
            return redirect()->route('voorwerpen.index')->with('msg', 'Voorwerp is already reserved');
        }

        $reservering = new Reserveringen();
        $reservering->UUID = Str::uuid()->toString();
        $reservering->VoorwerpUUID = $UUID;
        $reservering->MentorUUID = session('mentor_uuid');
        $reservering->save();

        return redirect()->route('voorwerpen.index')->with('msg', 'Voorwerp successfully reserved');
    }

    public function removereservatie($voorwerpuuid)
    {
        if (session('mentor_uuid') == null) {
            return redirect()->route('login')->with('msg', 'You need to be logged in to remove a reservation');
        }
        $reservering = Reserveringen::where('VoorwerpUUID', $voorwerpuuid)
                        ->where('MentorUUID', session('mentor_uuid'))
                        ->firstOrFail();
        if (!$reservering) {
            return redirect()->route('voorwerpen.index')->with('msg', 'Reservation not found');
        }
        $reservering->delete();

        return redirect()->route('voorwerpen.index')->with('msg', 'Reservation successfully removed');
    }

    public function create()
    {
        if(session('mentor_admin') == 1) {
            $Categories = Categories::all();
            return view('voorwerpen.create', compact('Categories'));
        // return view('voorwerpen.create');
        } else {
            return redirect('/voorwerpen')->with('msg', 'You are not authorized to create a new voorwerp');
        }
    }

    public function edit($id)
    {
        if(session('mentor_admin') == 1) {
            $voorwerp = Voorwerpen::findOrFail($id);
            $Categories = Categories::all();
            // $Foto = Foto::findOrFail($voorwerp->FotoUUID);
            // $QR = Qr::findOrFail($voorwerp->QRUUID);
            $QR = QR::where('UUID', $voorwerp->QRUUID)->firstOrFail();
            $Foto = null;

            if ($voorwerp->FotoUUID) {
                $Foto = Foto::where('UUID', $voorwerp->FotoUUID)->first();
            }
            return view('voorwerpen.edit', compact('voorwerp', 'Categories', 'Foto', 'QR'));
        } else {
            return redirect('/voorwerpen')->with('msg', 'You are not authorized to edit this voorwerp');
        }
    }

    // Sla een nieuw voorwerp op in de database
    public function store(Request $request)
    {

        $validated = $request->validate([
            'CategorieUUID' => 'required|exists:categories,UUID',
            'Naam' => 'required|string|max:100',
            'Beschrijving' => 'nullable|string',
            'Notities' => 'nullable|string',
            'Actief' => 'required|boolean',
        ]);
        $options = new QROptions;

        $options->outputType = QROutputInterface::GDIMAGE_PNG;


        $validated['leeftijd_van'] = intval($request->input('leeftijd_van'));
        $validated['leeftijd_tot'] = intval($request->input('leeftijd_tot'));

        if ($request->filled('Foto')) {
            $fotoUUID = Str::uuid()->toString();

            Foto::create([
                'UUID' => $fotoUUID,
                'Foto' => $request->input('Foto'),
            ]);

            $validated['FotoUUID'] = $fotoUUID;
        }

        $validated['UUID'] = Str::uuid()->toString();

        $qrUUID = Str::uuid()->toString();
        QR::create([
            'UUID' => $qrUUID,
            'qr' => (new QRCode($options))->render($validated['UUID']),
        ]);

        $validated['QRUUID'] = $qrUUID;

        Voorwerpen::create($validated);

        return redirect('/voorwerpen')->with('msg', 'Voorwerp created successfully');
    }

    // Toon een specifiek voorwerp
    public function show($id)
    {
        $voorwerp = Voorwerpen::findOrFail($id);
        $Categories = Categories::all();
        $Reserveringen = Reserveringen::all();
        $QR = QR::where('UUID', $voorwerp->QRUUID)->firstOrFail();
        $Foto = Foto::where('UUID', $voorwerp->FotoUUID)->firstOrFail();
        return view('voorwerpen.show', compact('voorwerp', 'Categories', 'Reserveringen', 'Foto', 'QR'));
    }

    // Werk de gegevens van een specifiek voorwerp bij
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'CategorieUUID' => 'required|exists:categories,UUID',
            'Naam' => 'required|string|max:100',
            'Beschrijving' => 'nullable|string',
            'Notities' => 'nullable|string',
            'Actief' => 'required|boolean',
        ]);

        $validated['leeftijd_van'] = intval($request->input('leeftijd_van'));
        $validated['leeftijd_tot'] = intval($request->input('leeftijd_tot'));

        $voorwerp = Voorwerpen::findOrFail($id);

        


        if ($request->filled('Foto')) {

            Foto::where('UUID', $voorwerp->FotoUUID)->delete();

            $fotoUUID = Str::uuid()->toString();

            Foto::create([
                'UUID' => $fotoUUID,
                'Foto' => $request->input('Foto'),
            ]);

            $validated['FotoUUID'] = $fotoUUID;
        }
    

        $voorwerp->update($validated);
    
        return redirect('/voorwerpen')->with('msg', 'Voorwerp updated successfully');
    }

    // Verwijder een voorwerp
    public function destroy($id)
    {
        if(session('mentor_admin') == 1) {
            $voorwerp = Voorwerpen::findOrFail($id);
            Uitleengeschiedenis::where('VoorwerpUUID', $id)->delete();
            $voorwerp->delete();
        
            return back()->with('msg', 'Voorwerp deleted successfully');
        } else {
            return redirect('/voorwerpen')->with('msg', 'You are not authorized to delete this voorwerp');
        }
    }
}
