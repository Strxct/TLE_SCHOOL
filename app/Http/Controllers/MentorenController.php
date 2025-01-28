<?php
namespace App\Http\Controllers;

use App\Models\Mentoren;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class MentorenController extends Controller
{
    public function showLoginForm()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['Email' => $credentials['email'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            $mentor = Auth::user();
            $request->session()->put('mentor_uuid', $mentor->UUID);
            $request->session()->put('mentor_name', $mentor->Voornaam);
            $request->session()->put('mentor_admin', $mentor->Admin);
            return redirect()->intended('/voorwerpen'); // Change this to your intended route
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
        // return view('login.login');
    }

    // Existing methods for managing mentoren
    public function index()
    {
        $Mentoren = Mentoren::latest()->paginate(5);
        $Session = auth()->user();
        return view('mentoren.index', compact('Mentoren', 'Session'));
    }

    public function create()
    {
        if(session('mentor_admin') == 1) {
            return view('mentoren.create');
        } else {
            return redirect('/mentoren')->with('msg', 'You are not authorized to create a new mentor');
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Voornaam' => 'required|string|max:255',
            'Achternaam' => 'required|string|max:255',
            'Email' => 'required|string|email|max:255|unique:mentoren',
            'Wachtwoord' => 'required|string|min:8',
            'Admin' => 'required|boolean',
        ]);

        $validated['Wachtwoord'] = Hash::make($validated['Wachtwoord']);
        $validated['UUID'] = Str::uuid()->toString();
        Mentoren::create($validated);

        return redirect()->route('mentoren.index')->with('success', 'Mentor created successfully.');
    }

    public function edit($id)
    {
        if(session('mentor_admin') == 1) {
            $Mentoren = Mentoren::findOrFail($id);
            return view('mentoren.edit', compact('Mentoren'));
        } else {
            return redirect('/mentoren')->with('msg', 'You are not authorized to edit a mentor');
        }
    }

    public function update(Request $request, $UUID)
    {
        $mentor = Mentoren::findOrFail($UUID);

        $validated = $request->validate([
            'Voornaam' => 'required|string|max:255',
            'Achternaam' => 'required|string|max:255',
            'Email' => 'required|string|email|max:255|unique:mentoren,Email,' . $mentor->UUID . ',UUID',
            'Wachtwoord' => 'nullable|string|min:8',
            'Admin' => 'required|boolean',
        ]);

        if ($request->filled('Wachtwoord')) {
            $validated['Wachtwoord'] = Hash::make($validated['Wachtwoord']);
        } else {
            unset($validated['Wachtwoord']);
        }

        $mentor->update($validated);

        return redirect()->route('mentoren.index')->with('success', 'Mentor updated successfully.');
    }

    public function destroy($id)
    {
        if(session('mentor_admin') == 1) {
            $mentor = Mentoren::findOrFail($id);
            $mentor->delete();

            return redirect()->route('mentoren.index')->with('success', 'Mentor deleted successfully.');
        } else {
            return redirect('/mentoren')->with('msg', 'You are not authorized to delete a mentor');
        }
    }
}