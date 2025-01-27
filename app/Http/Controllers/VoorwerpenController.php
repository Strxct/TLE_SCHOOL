<?php


namespace App\Http\Controllers;

use App\Models\Voorwerpen;  // Import the Voorwerpen model
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Categories;
use App\Models\Reserveringen;
use App\Models\Foto;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
use chillerlan\QRCode\{QRCode, QROptions};  
use chillerlan\QRCode\Output\{QROutputInterface};
use App\Models\Qr;

class VoorwerpenController extends Controller
{  

    // Toon een lijst van alle voorwerpen
    public function index()
    {
        $Categories = Categories::all();
        $Reserveringen = Reserveringen::all();
        $Voorwerpen = Voorwerpen::latest()->paginate(5);
        $Qr = Qr::all();
        $Foto = Foto::all();
        // return response()->json($voorwerpen);
        return view('voorwerpen.index', compact('Voorwerpen', 'Categories', 'Reserveringen', 'Foto', 'Qr'));
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
        $Foto = Foto::findOrFail($voorwerp->FotoUUID);
        $QR = Qr::findOrFail($voorwerp->QRUUID);
        return view('voorwerpen.edit', compact('voorwerp', 'Categories', 'Foto', 'QR'));
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
        Qr::create([
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
        $Foto = Foto::findOrFail($voorwerp->FotoUUID);
        return view('voorwerpen.show', compact('voorwerp', 'Categories', 'Reserveringen', 'Foto'));
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

        if ($request->filled('Foto')) {
            $fotoUUID = Str::uuid()->toString();

            Foto::create([
                'UUID' => $fotoUUID,
                'Foto' => $request->input('Foto'),
            ]);

            $validated['FotoUUID'] = $fotoUUID;
        }
    
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
